<?php


namespace App\Modules\Admin\Role\Traits;


use App\Modules\Admin\Role\Models\Role;

trait UserRoles
{
    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function canDo($alias, $require = false)
    {

    }

    public function hasRole($alias, $require = false)
    {

    }

    public function getMergedPermissions()
    {

    }

    public function getRoles()
    {

    }
}
