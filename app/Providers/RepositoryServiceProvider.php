<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register repositories.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBaseRepository();
        $this->registerUserRepository();
    }

    /**
     * Registering base repository
     */
    private function registerBaseRepository()
    {
        $this->app->bind(
            BaseRepositoryInterface::class,
            BaseRepository::class
        );
    }

    /**
     * Registering user repository
     */
    private function registerUserRepository()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }
}