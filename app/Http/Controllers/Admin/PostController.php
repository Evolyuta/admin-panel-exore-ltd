<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostFormRequest;
use App\Models\Post;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    protected string $model;

    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->middleware('auth');

        $this->categoryRepository = $categoryRepository;

        $this->model = Post::class;
    }

    /**
     * Create post view
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->checkAccess('create');

        $categories = $this->categoryRepository->getListForPostForm();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Storing new post
     *
     * @param CreatePostFormRequest $request
     */
    public function store(CreatePostFormRequest $request)
    {
        //
    }
}
