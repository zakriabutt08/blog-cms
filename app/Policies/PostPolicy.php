<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Helper to safely check Spatie permissions without throwing exceptions if they do not exist.
     */
    private function hasPermission(User $user, string $permission): bool
    {
        try {
            return $user->hasPermissionTo($permission);
        } catch (\Throwable $e) {
            // Fallback checking in case database is not seeded (e.g. during unit tests)
            try {
                if ($user->hasRole('Admin')) {
                    return true;
                }
                if ($user->hasRole('Author')) {
                    return in_array($permission, ['view-post', 'create-post', 'edit-post', 'delete-post']);
                }
                if ($user->hasRole('Reader')) {
                    return $permission === 'view-post';
                }
            } catch (\Throwable $ex) {
                // Ignore and return false if roles table also doesn't exist
            }
            return false;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasPermission($user, 'view-post');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        if ($post->published) {
            return $this->hasPermission($user, 'view-post');
        }

        // For unpublished/draft posts, only the Admin or the author can view
        try {
            if ($user->hasRole('Admin')) {
                return true;
            }
        } catch (\Throwable $e) {}

        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasPermission($user, 'create-post');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        if (!$this->hasPermission($user, 'edit-post')) {
            return false;
        }

        try {
            if ($user->hasRole('Admin')) {
                return true;
            }
        } catch (\Throwable $e) {}

        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        if (!$this->hasPermission($user, 'delete-post')) {
            return false;
        }

        try {
            if ($user->hasRole('Admin')) {
                return true;
            }
        } catch (\Throwable $e) {}

        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        try {
            return $user->hasRole('Admin');
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        try {
            return $user->hasRole('Admin');
        } catch (\Throwable $e) {
            return false;
        }
    }
}
