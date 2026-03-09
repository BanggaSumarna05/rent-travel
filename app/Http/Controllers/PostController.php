<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(9);

        return view('frontend.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if (!$post->is_published || $post->published_at > now()) {
            abort(404);
        }

        $recentPosts = Post::where('is_published', true)
            ->where('published_at', '<=', now())
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('frontend.posts.show', compact('post', 'recentPosts'));
    }
}
