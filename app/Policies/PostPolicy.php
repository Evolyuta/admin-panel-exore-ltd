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

    /**
     * Determine whether the user can edit the model.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function edit(User $user, Post $post): bool
    {
        return $this->checkPostOwnership($user, $post, true);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function update(User $user, Post $post): bool
    {
        return $this->checkPostOwnership($user, $post, true);
    }

    /**
     * Checking whether the user or his employees owns post
     *
     * @param User $user
     * @param Post $post
     * @param bool $onlyDirectAttribution
     * @return bool
     */
    private function checkPostOwnership(User $user, Post $post, bool $onlyDirectAttribution = false): bool
    {
        $employeeId = $post->employee_id;

        if (!$onlyDirectAttribution && $user->is_manager) {
            return $user->employees->pluck('id')->contains($employeeId);
        } else {
            return $employeeId === $user->id;
        }
    }

}
