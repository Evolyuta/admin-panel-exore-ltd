<?php


namespace App\Repositories\Interfaces;


/**
 * Interface BaseRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface BaseRepositoryInterface
{
    public function create(array $payload);

    public function getList(array $select = []);
}
