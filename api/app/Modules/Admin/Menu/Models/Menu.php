<?php

namespace App\Modules\Admin\Menu\Models;

use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public const MENU_TYPE_FRONT = 'front';
    public const MENU_TYPE_ADMIN = 'admin';

    public function scopeFrontMenu($query, User $user)
    {
        return $query
            ->where('type', self::MENU_TYPE_FRONT);
    }

    public function scopeMenuByType($query, $type)
    {
        return $query
            ->where('type', $type)
            ->orderBy('parent')
            ->orderBy('sort_order');
    }
}
