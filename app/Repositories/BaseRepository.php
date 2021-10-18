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

    /**
     * Getting model instance by id
     *
     * @param int $id
     * @param array $select
     * @param array $relationships
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getById(int $id, array $select = [], array $relationships = [])
    {
        if (!empty($select)) {
            $this->query = $this->query->select($select);
        }
        if (!empty($relationships)) {
            $this->query = $this->query->with($relationships);
        }

        return $this->query->findOrFail($id);
    }

    /**
     * Deleting model instance
     *
     * @param Model $model
     */
    public function delete(Model $model)
    {
        $model->delete();
    }
}
