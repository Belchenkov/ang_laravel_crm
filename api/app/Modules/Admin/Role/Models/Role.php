<?php

namespace App\Modules\Admin\Role\Models;

use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'alias',
        'title'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function perms(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function savePermissions(array $perms)
    {
        if (! empty($perms)) {
            $this->perms()->sync($perms);
        } else {
            $this->perms()->detach();
        }
    }

    public function hasPermission($alias, $require = false)
    {
        if (is_array($alias)) {
            foreach ($alias as $permission_alias) {
                $has_permissions = $this->hasPermission($permission_alias);

                if ($has_permissions && ! $require) {
                    return true;
                } elseif (! $has_permissions && $require) {
                    return false;
                }
            }
        } else {
            foreach ($this->perms as $permission) {
                if ($permission->alias == $alias) {
                    return true;
                }
            }
        }

        return $require;
    }
}
