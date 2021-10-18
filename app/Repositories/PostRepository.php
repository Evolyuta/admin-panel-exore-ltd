<?php


namespace App\Repositories;


use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * PostRepository constructor.
     *
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    /**
     * Getting post list with authed user as author
     *
     * @param array $parameters
     * @return mixed
     */
    public function getListByAuthedEmployee(array $parameters = [])
    {
        return $this->getListByAuthedUser('posts', $parameters)->select(['id', 'name'])->paginate(10);
    }

    private function getListByAuthedUser(string $relationship, array $parameters = [])
    {
        $filter = [];
        if (!empty($parameters['category_id'])) {
            $filter = ['category_id' => (int)$parameters['category_id']];
        }
        if (!empty($parameters['employee_id'])) {
            $filter = ['employee_id' => (int)$parameters['employee_id']];
        }

        return auth()->user()->{$relationship}()->where($filter);
    }

    /**
     * Getting post list with authed user as manager of authors
     *
     * @param array $parameters
     * @return mixed
     */
    public function getListByAuthedManager(array $parameters = [])
    {
        return $this->getListByAuthedUser('employeePosts', $parameters)->paginate(10);
    }

    /**
     * Getting post instance by id for detail page by manager
     *
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getByIdForDetailPageForManager(int $id)
    {
        return $this->getByIdForDetailPage($id, ['employee:id,name'], ['employee_id']);
    }

    /**
     * Getting post instance by id for detail page
     *
     * @param int $id
     * @param array $additionalRelationships
     * @param array $additionalSelect
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getByIdForDetailPage(int $id, array $additionalRelationships = [], array $additionalSelect = [])
    {
        $relationships = array_merge(['category:id,name'], $additionalRelationships);
        $select = array_merge(
            [
                'id',
                'name',
                'image_path',
                'category_id',
            ],
            $additionalSelect
        );

        return $this->getById(
            $id,
            $select,
            $relationships
        );
    }

    /**
     * Getting post instance by id for edit page
     *
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getByIdForEditForm(int $id)
    {
        return $this->getById($id, [
            'id',
            'name',
            'category_id',
        ]);
    }

    /**
     * Getting post instance by id for updating method
     *
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getByIdForUpdating(int $id)
    {
        return $this->getById($id, [
            'id',
            'image_path',
        ]);
    }
}
