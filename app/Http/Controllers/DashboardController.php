<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the appropriate dashboard based on user role.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $data = [];

        if ($user->hasRole('Admin')) {
            $data['totalPosts'] = Post::count();
            $data['publishedPosts'] = Post::where('published', true)->count();
            $data['unpublishedPosts'] = $data['totalPosts'] - $data['publishedPosts'];
            $data['totalUsers'] = User::count();

            // Fetch all posts with author info
            $data['posts'] = Post::with('user')->latest()->get();
            // Fetch all users with their roles
            $data['users'] = User::with('roles')->get();
        } elseif ($user->hasRole('Author')) {
            $data['totalPosts'] = $user->posts()->count();
            $data['publishedPosts'] = $user->posts()->where('published', true)->count();
            $data['unpublishedPosts'] = $data['totalPosts'] - $data['publishedPosts'];

            // Fetch the author's own posts
            $data['posts'] = $user->posts()->latest()->get();
        } else {
            // Reader Role (or fallback)
            // Fetch only published posts for the feed
            $data['posts'] = Post::where('published', true)->with('user')->latest()->get();
        }

        return view('dashboard', $data);
    }
}
