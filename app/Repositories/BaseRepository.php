<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

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
