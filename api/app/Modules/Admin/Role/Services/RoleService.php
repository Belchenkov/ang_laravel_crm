<?php


namespace App\Modules\Admin\Role\Services;


use App\Modules\Admin\Role\Requests\RoleRequest;
use Illuminate\Database\Eloquent\Model;

class RoleService
{
    public function save(RoleRequest $request, Model $model)
    {
        $model->fill($request->only($model->getFillable()));
        $model->save();

        return true;
    }
}
