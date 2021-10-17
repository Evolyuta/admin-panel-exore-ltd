<?php

namespace App\Policies;

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
}
