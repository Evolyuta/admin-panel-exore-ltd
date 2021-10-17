<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Checking whether the user can perform a given manipulation with the model
     *
     * @param string $method
     * @param Model|null $instance
     * @throws AuthorizationException
     */
    protected function checkAccess(string $method, Model $instance = null)
    {
        if (!empty($this->model)) {
            $argument = $this->model;

            if (!empty($instance)) {
                $argument = [$argument, $instance];
            }

            $this->authorize($method, $argument);
        }
    }
}
