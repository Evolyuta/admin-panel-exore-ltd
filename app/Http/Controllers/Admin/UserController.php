<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserFormRequest;
use App\Models\User;
use App\Normalizer\CreateUserNormalizer;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    protected string $model;

    private UserRepositoryInterface $userRepository;

    private CreateUserNormalizer $createUserNormalizer;

    public function __construct(
        UserRepositoryInterface $userRepository,
        CreateUserNormalizer    $createUserNormalizer
    )
    {
        $this->middleware('auth');

        $this->model = User::class;

        $this->userRepository = $userRepository;
        $this->createUserNormalizer = $createUserNormalizer;
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

        return view('admin.users.create');
    }

    /**
     * Storing new user
     *
     * @param CreateUserFormRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(CreateUserFormRequest $request): RedirectResponse
    {
        $this->checkAccess('store');

        $payload = $this->createUserNormalizer->normalize($request->all());

        $this->userRepository->create($payload);

        return redirect()->route('admin.index')->with(['status' => 'User successfully created']);
    }
}
