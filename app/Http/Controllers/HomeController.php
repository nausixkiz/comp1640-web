<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Support\Renderable;
use Spatie\Analytics\Period;

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
}
