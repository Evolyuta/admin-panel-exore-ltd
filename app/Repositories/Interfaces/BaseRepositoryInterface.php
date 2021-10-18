<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Model;

/**
 * Interface BaseRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface BaseRepositoryInterface
{
    public function create(array $payload);

    public function getList(array $select = []);

    public function getById(int $id, array $select = [], array $relationships = []);

    public function delete(Model $model);
}
