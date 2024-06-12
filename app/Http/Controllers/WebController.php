<?php

namespace App\Http\Controllers;

use App\Models\Post;

class WebController extends Controller
{
    public function index ()
    {
        $posts = Post::all();
        return view('index', compact('posts'));
    }

    public function page (Post $post)
    {
        return view('page', compact('post'));
    }
}



