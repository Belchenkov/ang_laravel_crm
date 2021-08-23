<?php

namespace App\Modules\Admin\User\Controllers\Api;

use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\User\Requests\UserRequest;
use App\Modules\Admin\User\Services\UserService;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        //$this->authorize('view', new User());

        $users = $this->service->getUsers();

        return ResponseService::sendJsonResponse(true, 200, [], [
            'items' => $users->toArray()
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = $this->service->save($request, new User());

        return ResponseService::sendJsonResponse(true, 200, [], [
            'user' => $user->toArray()
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $user = $this->service->save($request, $user);

        return ResponseService::sendJsonResponse(true, 200, [], [
            'user' => $user->toArray()
        ]);
    }


    public function destroy(User $user)
    {
        $user->status = User::NOT_ACTIVE;
        $user->update();

        return ResponseService::sendJsonResponse(true, 200, [], [
            'user' => $user->toArray()
        ]);
    }

    public function usersForm()
    {
        $this->authorize('view', new User());

        $users = $this->service->getUsers(User::ACTIVE);

        return ResponseService::sendJsonResponse(true, 200, [], [
            'users' => $users->toArray()
        ]);
    }
}
