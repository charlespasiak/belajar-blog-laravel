<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Post $post)
    {
        $data = $post->orderBy('created_at', 'desc')->get();
        return view('blog', compact('data'));
    }

    public function isi_blog($slug)
    {
        $data = Post::where('slug', $slug)->get();
        return view('content.isi_post', compact('data'));
    }
}
