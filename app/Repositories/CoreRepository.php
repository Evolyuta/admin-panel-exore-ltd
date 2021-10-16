<?php

namespace App\Repositories;

abstract class CoreRepository
{
    /**
     * Creating model instance
     *
     * @param array $payload
     * @return mixed
     */
    public function create(array $payload)
    {
        return $this->model::create($payload);
    }
}
