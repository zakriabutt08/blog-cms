<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    private function canPublish(Request $request): bool
    {
        try {
            return $request->user()->hasPermissionTo('publish-post');
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Filter posts that the user is authorized to view
        $posts = Post::with('user')->latest()->get()->filter(function ($post) {
            return auth()->user()->can('view', $post);
        });

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Post::class);

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Post::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'published' => 'sometimes|boolean',
        ]);

        $published = $request->boolean('published');

        if ($published && !$this->canPublish($request)) {
            abort(403, 'You do not have permission to publish posts.');
        }

        $post = $request->user()->posts()->create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'published' => $published,
        ]);

        $status = $post->published ? 'published' : 'saved as draft';
        return redirect()->route('dashboard')->with('success', "Post created successfully and {$status}!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        Gate::authorize('view', $post);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Handle publish/unpublish toggle (Admin only)
        if ($request->has('toggle_publish')) {
            if (!$request->user()->hasRole('Admin')) {
                abort(403, 'Only Admins can publish or unpublish posts.');
            }
            
            $post->update([
                'published' => !$post->published
            ]);

            $status = $post->published ? 'published' : 'unpublished';
            return redirect()->back()->with('success', "Post has been successfully {$status}!");
        }

        Gate::authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'published' => 'sometimes|boolean',
        ]);

        if ($request->has('published')) {
            if (!$this->canPublish($request)) {
                abort(403, 'You do not have permission to change publish status.');
            }

            $validated['published'] = $request->boolean('published');
        }

        $post->update($validated);

        return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }
}
