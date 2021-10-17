<?php


namespace App\Repositories\Interfaces;


/**
 * Interface CategoryRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getListForPostForm();
}
