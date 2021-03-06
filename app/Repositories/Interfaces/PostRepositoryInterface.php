<?php


namespace App\Repositories\Interfaces;


/**
 * Interface PostRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface PostRepositoryInterface extends BaseRepositoryInterface
{
    public function getListByAuthedEmployee(array $parameters = []);

    public function getListByAuthedManager(array $parameters = []);

    public function getByIdForDetailPage(int $id);

    public function getByIdForDetailPageForManager(int $id);

    public function getByIdForEditForm(int $id);

    public function getByIdForChanging(int $id);
}
