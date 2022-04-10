<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Transformers\CommentTransfermer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

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
