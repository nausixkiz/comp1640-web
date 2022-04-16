<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Transformers\CategoryTransformer;
use App\Transformers\PostTransformer;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\MediaStream;
use ZipStream\Option\Archive as ArchiveOptions;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('contents.post.index', [
            'posts' => Post::all()->transformWith(new PostTransformer())->toArray(),
            'categories' => Category::all()->transformWith(new CategoryTransformer())->toArray(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('contents.post.create', [
            'categories' => Category::all()->transformWith(new CategoryTransformer())->toArray(),
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
            'name' => ['required', 'string', 'max:255'],
            'short-description' => ['required', 'max:255'],
            'contents' => ['required', 'string', 'min:10', 'max:10000'],
            'thump' => ['required', 'image', 'mimes:jpg,jpeg,png,bmp'],
            'documents.*' => ['required', 'file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,txt,jpg,jpeg,png,bmp'],
            'terms' => ['accepted', 'required'],
        ])->validate();

        $post = new Post();
        $post->name = $request->input('name');
        $post->short_description = $request->input('short-description');
        $post->contents = $request->input('contents');
        $post->category()->associate($request->input('category'));
        $post->user()->associate(Auth::user());
        $post->save();
        $post->addMediaFromRequest('thump')->toMediaCollection('thump');

        foreach ($request->file('documents') as $document) {
            $post->addMedia($document)->toMediaCollection('documents');
        }

        return redirect()->route('posts.index')->with('flash_success_message', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $post = Post::findBySlugOrFail($slug);

        views($post)->record();

        return view('contents.post.show', [
            'post' => $post,
            'comments' => $post->comments()->paginate(3),
            'comment_total' => $post->comments()->count(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return void
     */
    public function edit($slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $slug
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return RedirectResponse
     */
    public function destroy($slug)
    {
        $post = Post::findBySlugOrFail($slug);

        $post->delete();

        return redirect()->route('posts.index')->with('flash_success_message', 'Post deleted successfully');
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
            // Let's get some media.
            $documents = $post->getMedia('documents');

            // Download the files associated with the media in a streamed way.
            // No prob if your files are very large.
            return MediaStream::create($post->slug . '-documents-' . Carbon::now()->format('Y-m-d') . '.zip')
                ->useZipOptions(function (ArchiveOptions $zipOptions) {
                    $zipOptions->setZeroHeader(true);
                })
                ->addMedia($documents);
        }

        return back()->with('flash_error_message', 'No documents found');
    }
}
