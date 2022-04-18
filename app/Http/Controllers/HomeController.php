<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('contents.home', [
            'departments' => Department::all(),
            'categories' => Category::all(),
            'posts' => Post::paginate(10),
            'sorted' => [
                'most-view' => false,
                'most-comment' => false,
                'most-like' => false,
            ],
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     * @throws ValidationException
     */
    public function indexSorted(Request $request)
    {
        Validator::make($request->all(), [
            'sort' => ['required', Rule::in(['most-view', 'most-comment', 'most-like'])],
            'order' => ['required', 'in:asc,desc'],
        ])->validate();

        $posts = match ($request->input('sort')) {
            'most-view' => Post::orderByViews($request->input('order'))->paginate(10),
            'most-comment' => Post::orderByComments($request->input('order'))->paginate(10),
            'most-like' => Post::orderByLikes($request->input('order'))->paginate(10),
            default => Post::paginate(10),
        };

        return view('contents.home', [
            'departments' => Department::all(),
            'categories' => Category::all(),
            'posts' => $posts,
            'sorted' => [
                'most-view' => $request->input('sort') === 'most-view',
                'most-comment' => $request->input('sort') === 'most-comment',
                'most-like' => $request->input('sort') === 'most-like',
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Application|Factory|View
     */
    public function showIdea($slug)
    {
        $post = Post::findBySlugOrFail($slug);

        views($post)->record();

        return view('contents.post.show', [
            'post' => $post,
            'comments' => $post->comments()->paginate(3),
            'comment_total' => $post->comments()->count(),
        ]);
    }
}
