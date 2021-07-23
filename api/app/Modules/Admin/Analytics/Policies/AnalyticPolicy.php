<?php

namespace App\Modules\Admin\Analytics\Policies;

use App\Modules\Admin\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

trait AnalyticPolicy
{
    use HandlesAuthorization;

    public function viewAnalytic(User $user)
    {
        return $user->canDo(['view']);
    }
}
