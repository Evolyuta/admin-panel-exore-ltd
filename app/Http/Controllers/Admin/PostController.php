<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostFormRequest;
use App\Models\Post;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Services\FileService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    protected string $model;

    private CategoryRepositoryInterface $categoryRepository;

    private PostRepositoryInterface $postRepository;

    private FileService $fileService;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        PostRepositoryInterface     $postRepository,
        FileService                 $fileService
    )
    {
        $this->middleware('auth');

        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;

        $this->fileService = $fileService;

        $this->model = Post::class;
    }

    /**
     * Post list table.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        if (auth()->user()->is_manager) {
            $posts = $this->postRepository->getListByAuthedManager();
        } else {
            $posts = $this->postRepository->getListByAuthedEmployee();
        }

        return view('admin.index', compact('posts'));
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
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(CreatePostFormRequest $request): RedirectResponse
    {
        $this->checkAccess('store');

        $request['image_path'] = $this->fileService->upload($request->image, 'images');

        $this->postRepository->create($request->all());

        return redirect()->route('admin.index')->with(['status' => 'Post successfully created']);
    }
}
