<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if (!isset($validated['is_published'])) {
            $validated['is_published'] = false;
        }

        $post = Post::create($validated);

        if ($request->hasFile('image')) {
            $post->addMedia($request->file('image'))->toMediaCollection('posts');
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dibuat.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if (!isset($validated['is_published'])) {
            $validated['is_published'] = false;
        }

        $post->update($validated);

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('posts');
            $post->addMedia($request->file('image'))->toMediaCollection('posts');
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus.');
    }
}
