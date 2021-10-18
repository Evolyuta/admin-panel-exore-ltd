<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostFormRequest;
use App\Http\Requests\Post\IndexPostFormRequest;
use App\Http\Requests\Post\UpdatePostFormRequest;
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
     * @param IndexPostFormRequest $request
     * @return Renderable
     */
    public function index(IndexPostFormRequest $request): Renderable
    {
        $parameters = $request->all();

        if (auth()->user()->is_manager) {
            $posts = $this->postRepository->getListByAuthedManager($parameters);
        } else {
            $posts = $this->postRepository->getListByAuthedEmployee($parameters);
        }

        return view('admin.index', compact('posts'));
    }

    /**
     * Post index view.
     *
     * @param int $postId
     * @return Renderable
     * @throws AuthorizationException
     */
    public function show(int $postId): Renderable
    {
        if (auth()->user()->is_manager) {
            $post = $this->postRepository->getByIdForDetailPageForManager($postId);
        } else {
            $post = $this->postRepository->getByIdForDetailPage($postId);
        }

        $this->checkAccess('view', $post);

        return view('admin.posts.show', compact('post'));
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

    /**
     * Edit post view
     *
     * @param int $postId
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(int $postId)
    {
        $post = $this->postRepository->getByIdForEditForm($postId);

        $this->checkAccess('edit', $post);

        $categories = $this->categoryRepository->getListForPostForm();

        return view('admin.posts.create', compact('post', 'categories'));
    }

    /**
     * Updating post
     *
     * @param UpdatePostFormRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdatePostFormRequest $request): RedirectResponse
    {
        $post = $this->postRepository->getByIdForUpdating($request['id']);

        $this->checkAccess('update', $post);

        if (!empty($request->image)) {
            $this->fileService->delete($post->image_path);
            $request['image_path'] = $this->fileService->upload($request->image, 'images');
        }

        $this->postRepository->update($post, $request->all());

        return redirect()->route('admin.index')->with(['status' => 'Post successfully updated']);
    }

    /**
     * Post delete method.
     *
     * @param int $postId
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function delete(int $postId): RedirectResponse
    {
        $post = $this->postRepository->getById($postId, ['id']);

        $this->checkAccess('delete', $post);

        $this->fileService->delete($post->image_path);

        $this->postRepository->delete($post);

        return redirect()->route('admin.index')->with(['status' => 'Post successfully deleted']);
    }
}
