<?php


namespace App\Repositories;


use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

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
    public function getListByAuthedEmployee()
    {
        return auth()->user()->posts()->select(['id', 'name'])->paginate(10);
    }

    /**
     * Getting post list with authed user as manager of authors
     *
     * @return mixed
     */
    public function getListByAuthedManager()
    {
        return auth()->user()->employeePosts()->paginate(10);
    }
}
