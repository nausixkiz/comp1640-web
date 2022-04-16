<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Transformers\CommentTransfermer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('contents.comment.index', [
            'comments' => Comment::all()->transformWith(new CommentTransfermer())->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'contents' => ['required', 'string', 'max:255'],
            'post-slug' => ['required', 'string', 'max:255', 'exists:posts,slug'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ])->validate();

        $post = Post::findBySlugOrFail($request->input('post-slug'));

        $comment = new Comment();
        $comment->contents = $request->input('contents');
        $comment->is_anonymous = $request->input('comment-as-anonymous', 'off') === 'on';

        $comment->user()->associate(Auth::user());
        $comment->post()->associate($post);
        $comment->save();

        return redirect()->back()->with('flash_success_message', 'Comment created successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        Comment::destroy($id);

        Session::flash('flash_success_message', 'Comment successfully deleted!');

        return back();
    }
}
