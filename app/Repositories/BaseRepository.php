<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    protected Builder $query;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;

        $this->query = $this->model->query();
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

    /**
     * Getting model instances list
     *
     * @param array $select
     * @return Builder[]|Collection
     */
    public function getList(array $select = [])
    {
        if (!empty($select)) {
            return $this->query->get($select);
        }

        return $this->query->get();
    }
}
