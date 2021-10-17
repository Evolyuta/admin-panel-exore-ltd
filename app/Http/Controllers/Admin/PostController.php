<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    protected string $model;


    public function __construct()
    {
        $this->middleware('auth');

        $this->model = Post::class;
    }

    /**
     * Create user view
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->checkAccess('create');

        $categories = Category::get('name');

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Storing new post
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }
}
