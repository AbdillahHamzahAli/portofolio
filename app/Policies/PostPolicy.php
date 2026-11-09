<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('ViewAny:Post');
    }

    public function view(User $user, Post $post): bool
    {
        return $user->can('View:Post') && ($user->hasRole('admin') || $post->user_id === $user->id);
    }

    public function create(User $user): bool
    {
        return $user->can('Create:Post');
    }

    public function update(User $user, Post $post): bool
    {
        return $user->can('Update:Post') && ($user->hasRole('admin') || $post->user_id === $user->id);
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->can('Delete:Post') && ($user->hasRole('admin') || $post->user_id === $user->id);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasRole('admin') && $user->can('DeleteAny:Post');
    }

    public function restore(User $user, Post $post): bool
    {
        return $user->can('Restore:Post') && ($user->hasRole('admin') || $post->user_id === $user->id);
    }

    public function forceDelete(User $user, Post $post): bool
    {
        return $user->can('ForceDelete:Post') && ($user->hasRole('admin') || $post->user_id === $user->id);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasRole('admin') && $user->can('ForceDeleteAny:Post');
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasRole('admin') && $user->can('RestoreAny:Post');
    }

    public function replicate(User $user, Post $post): bool
    {
        return $user->can('Replicate:Post') && ($user->hasRole('admin') || $post->user_id === $user->id);
    }

    public function reorder(User $user): bool
    {
        return $user->hasRole('admin') && $user->can('Reorder:Post');
    }
}
