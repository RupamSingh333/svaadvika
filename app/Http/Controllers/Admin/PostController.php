<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
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
            'content' => 'nullable|string',
            'type' => 'required|in:page,blog,recipe',
            'status' => 'required|in:published,draft',
        ]);
        
        $validated['slug'] = Str::slug($validated['title']);

        Post::create($validated);
        
        return redirect()->route('admin.posts.index')->with('success', 'Content created successfully');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'type' => 'required|in:page,blog,recipe',
            'status' => 'required|in:published,draft',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $post->update($validated);
        
        return redirect()->route('admin.posts.index')->with('success', 'Content updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Content deleted successfully');
    }
}
