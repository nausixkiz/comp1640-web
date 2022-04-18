<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('contents.post.index_for_admin', [
            'posts' => Post::all(),
        ]);
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
}
