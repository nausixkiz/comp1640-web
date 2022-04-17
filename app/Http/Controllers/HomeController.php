<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
            'posts' => Post::orderBy('updated_at', 'desc')->get(),
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
