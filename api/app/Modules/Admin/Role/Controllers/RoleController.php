<?php

namespace App\Modules\Admin\Role\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Requests\RoleRequest;
use App\Modules\Admin\Role\Services\RoleService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Base
{
    public function __construct(RoleService $roleService)
    {
        parent::__construct();

        $this->service = $roleService;
    }

    public function index()
    {
        $this->authorize('view', Role::class);

        $roles = Role::all();

        $this->title = "Title Role index";
        $this->content = view('Admin::Role.index')
            ->with([
                'roles' => $roles,
                'title' => $this->title
            ])
            ->render();

        return $this->renderOutput();
    }

    public function create()
    {
        $this->authorize('create', Role::class);

        $this->title = "Title Role create";
        $this->content = view('Admin::Role.create')
            ->with([
                'title' => $this->title
            ])
            ->render();

        return $this->renderOutput();
    }

    public function store(RoleRequest $request)
    {
        $this->service->save($request, new Role());

        return Redirect::route('roles.index')
            ->with([
                'message' => __('Success')
            ]);
    }

    public function edit(Role $role)
    {
        $this->authorize('edit', Role::class);

        $this->title = "Title Role edit";
        $this->content = view('Admin::Role.edit')
            ->with([
                'title' => $this->title,
                'item' => $role
            ])
            ->render();

        return $this->renderOutput();
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->service->save($request, $role);

        return Redirect::route('roles.index')
            ->with([
                'message' => __('Success')
            ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return Redirect::route('roles.index')
            ->with([
                'message' => __('Success')
            ]);
    }
}
