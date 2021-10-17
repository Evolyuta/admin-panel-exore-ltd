<?php


namespace App\Repositories\Interfaces;


/**
 * Interface PostRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface PostRepositoryInterface extends BaseRepositoryInterface
{
    public function getListByAuthedEmployee($filter = []);

    public function getListByAuthedManager($filter = []);

    public function getByIdForDetailPage(int $id, array $additionalRelationships = [], array $additionalSelect = []);

    public function getByIdForDetailPageForManager(int $id);
}
