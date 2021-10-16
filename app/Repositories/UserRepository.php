<?php


namespace App\Repositories;


use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends CoreRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected User $model;

    public function __construct()
    {
        $this->model = new User();
    }
}
