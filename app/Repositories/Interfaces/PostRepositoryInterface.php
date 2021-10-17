<?php


namespace App\Repositories\Interfaces;


/**
 * Interface PostRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface PostRepositoryInterface extends BaseRepositoryInterface
{
    public function getListByAuthedEmployee();

    public function getListByAuthedManager();
}
