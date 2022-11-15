<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // latest post and paginte by 12
        $posts = Post::latest()->paginate(12);
        
        return view('home', compact('posts'));
    }
}
