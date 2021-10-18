<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return !$user->is_manager;
    }

    /**
     * Determine whether the user can store models.
     *
     * @param User $user
     * @return bool
     */
    public function store(User $user): bool
    {
        return !$user->is_manager;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function view(User $user, Post $post): bool
    {
        return $this->checkPostOwnership($user, $post);
    }

    /**
     * Checking whether the user or his employees owns post
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    private function checkPostOwnership(User $user, Post $post): bool
    {
        if ($user->is_manager) {
            $posts = $user->employeePosts->pluck('id')->toArray();
        } else {
            $posts = $user->posts->pluck('id')->toArray();
        }

        return in_array($post->id, $posts);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function delete(User $user, Post $post): bool
    {
        return $this->checkPostOwnership($user, $post);
    }
}
