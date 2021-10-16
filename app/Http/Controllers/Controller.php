<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
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
     * @throws AuthorizationException
     */
    protected function checkAccess(string $method)
    {
        if (!empty($this->model)) {
            $this->authorize($method, $this->model);
        }
    }
}
