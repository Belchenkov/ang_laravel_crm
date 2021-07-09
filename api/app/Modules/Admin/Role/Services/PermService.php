<?php


namespace App\Modules\Admin\Role\Services;


use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Requests\RoleRequest;
use Illuminate\Http\Request;

class PermService
{
    public function save(Request $request)
    {
        $data = $request->except('_token');

        $roles = Role::all();

        foreach ($roles as $role) {
            if (isset($data[$role->id])) {
                $role->savePermissions($data[$role->id]);
            } else {
                $role->savePermissions([]);
            }
        }
    }
}
