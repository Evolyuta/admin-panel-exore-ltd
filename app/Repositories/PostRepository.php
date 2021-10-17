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
     * @return mixed
     */
    public function getListByAuthedEmployee($filter = [])
    {
        return auth()->user()->posts()->select(['id', 'name'])->where($filter)->paginate(10);
    }

    /**
     * Getting post list with authed user as manager of authors
     *
     * @return mixed
     */
    public function getListByAuthedManager($filter = [])
    {
        return auth()->user()->employeePosts()->where($filter)->paginate(10);
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
}
