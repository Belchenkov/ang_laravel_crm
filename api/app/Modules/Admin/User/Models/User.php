<?php

namespace App\Modules\Admin\User\Models;

use App\Modules\Admin\Role\Traits\UserRoles;
use App\Modules\Admin\Task\Models\Traits\UserTasksTrait;
use App\Modules\Admin\User\Traits\UserLeadsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthUser;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App\Modules\Admin\User\Models
 * @property string firstname
 * @property string lastname
 * @property string full_name
 */
class User extends AuthUser
{
    use HasFactory, HasApiTokens, UserRoles, UserLeadsTrait, UserTasksTrait;

    public const ACTIVE = 1;
    public const NOT_ACTIVE = 0;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'status',
    ];

    protected $hidden = [
        'password'
    ];

    public function getFullNameAttribute(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
