<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Department;
use App\Models\Post;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\MediaStream;
use ZipStream\Option\Archive as ArchiveOptions;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('contents.post.index_for_staff', [
            'ideas' => Auth::user()->posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:6', 'max:30'],
            'short-description' => ['required', 'min:6', 'max:50'],
            'contents' => ['required', 'string', 'min:10', 'max:10000'],
            'category' => ['required', 'exists:categories,slug'],
            'thumbnail' => ['required', 'image', 'mimes:jpg,jpeg,png,bmp'],
            'documents.*' => ['required', 'file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,txt,jpg,jpeg,png,bmp'],
            'terms' => ['accepted', 'required'],
        ])->validate();
        $category = Category::findBySlugOrFail($request->input('category'));

        if ($category->hasExpired()) {
            Session::flash('flash_error_message', 'This category has expired');
            return redirect()->back();
        }

        $post = new Post();
        $post->name = $request->input('name');
        $post->short_description = $request->input('short-description');
        $post->contents = $request->input('contents');
        $post->category()->associate($category);
        $post->user()->associate(Auth::user());
        $post->save();
        $post->addMediaFromRequest('thumbnail')
            ->toMediaCollection('thumbnail');

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $post->addMedia($document)->toMediaCollection('documents');
            }
        }

        return redirect()->route('home')->with('flash_success_message', 'Post created successfully');
    }

    /**
     * Store a newly a comment resource in storage.
     *
     * @param Request $request
     * @param string $slug
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function storeComment(Request $request, string $slug)
    {
        Validator::make($request->all(), [
            'contents' => ['required', 'string', 'max:255'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ])->validate();

        $post = Post::findBySlugOrFail($slug);

        if ($post->hasExpired()) {
            Session::flash('flash_error_message', 'Post has expired');
            return redirect()->back();
        }

        $comment = new Comment();
        $comment->contents = $request->input('contents');
        $comment->is_anonymous = $request->input('comment-as-anonymous', 'off') === 'on';

        $comment->user()->associate(Auth::user());
        $comment->post()->associate($post);
        $comment->save();

        return redirect()->back()->with('flash_success_message', 'Comment created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return Application|Factory|View
     */
    public function edit($slug)
    {
        $post = Post::findBySlugOrFail($slug);

        return view('contents.post.edit', [
            'post' => $post,
            'departments' => Department::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $slug
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $slug)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:6', 'max:30'],
            'short-description' => ['required', 'min:6', 'max:50'],
            'contents' => ['required', 'string', 'min:10', 'max:10000'],
            'category' => ['required', 'exists:categories,slug'],
            'thumbnail' => ['image', 'mimes:jpg,jpeg,png,bmp'],
            'documents.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,txt,jpg,jpeg,png,bmp'],
            'terms' => ['accepted', 'required'],
        ])->validate();

        $category = Category::findBySlugOrFail($request->input('category'));

        if ($category->hasExpired()) {
            Session::flash('flash_error_message', 'This category has expired');
            return redirect()->back();
        }

        try {
            $post = Post::findBySlugOrFail($slug);
            $post->name = $request->input('name');
            $post->short_description = $request->input('short-description');
            $post->contents = $request->input('contents');
            $post->category()->associate($category);
            $post->save();

            if ($request->hasFile('thumbnail')) {
                $post->clearMediaCollection('thumbnail');

                $post->addMediaFromRequest('thumbnail')
                    ->toMediaCollection('thumbnail');
            }

            if ($request->hasFile('documents')) {
                $post->clearMediaCollection('documents');

                foreach ($request->file('documents') as $document) {
                    $post->addMedia($document)->toMediaCollection('documents');
                }
            }

            return redirect()->route('home')->with('flash_success_message', 'Post updated successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('home')->with('flash_error_message', 'Post update failed');
        }
    }

    public function downloadADocument($slug, Media $media)
    {
        Post::findBySlugOrFail($slug);

        return response()->download($media->getPath(), $media->file_name);
    }

    public function downloadAllDocuments($slug): MediaStream|RedirectResponse
    {
        $post = Post::findBySlugOrFail($slug);

        if ($post->hasMedia('documents')) {
            $documents = $post->getMedia('documents');

            return MediaStream::create($post->slug . '-documents-' . Carbon::now()->format('Y-m-d') . '.zip')
                ->useZipOptions(function (ArchiveOptions $zipOptions) {
                    $zipOptions->setZeroHeader(true);
                })
                ->addMedia($documents);
        }

        return back()->with('flash_error_message', 'No documents found');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('contents.post.create', [
            'departments' => Department::all(),
        ]);
    }

    public function like(string $slug)
    {
        $user = Auth::user();
        $post = Post::findBySlugOrFail($slug);

        if ($user->hasDisliked($post)) {
            $user->removeDislike($post);
        }

        if (!$user->hasLiked($post)) {
            $user->like($post);
        }

        return redirect()->back();
    }

    public function removeDislike(string $slug)
    {
        $user = Auth::user();
        $post = Post::findBySlugOrFail($slug);

        if ($user->hasDisliked($post)) {
            $user->removeDislike($post);
        }

        return redirect()->back();
    }

    public function dislike(string $slug)
    {
        $user = Auth::user();
        $post = Post::findBySlugOrFail($slug);

        if ($user->hasLiked($post)) {
            $user->removeLike($post);
        }

        if (!$user->hasDisliked($post)) {
            $user->dislike($post);
        }

        return redirect()->back();
    }

    public function removeLike(string $slug)
    {
        $user = Auth::user();
        $post = Post::findBySlugOrFail($slug);

        if ($user->hasLiked($post)) {
            $user->removeLike($post);
        }

        return redirect()->back();
    }
}
