<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Transformers\PostTransformer;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('contents.home', [
            'posts' => Post::orderBy('updated_at', 'desc')->get()->transformWith(new PostTransformer())->toArray(),
        ]);
    }
}
