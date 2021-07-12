<?php

namespace App\Modules\Admin\User\Models;

use App\Modules\Admin\Role\Traits\UserRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthUser;
use Laravel\Passport\HasApiTokens;

class User extends AuthUser
{
    use HasFactory, HasApiTokens, UserRoles;

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
}
