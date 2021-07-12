<?php

namespace App\Modules\Admin\Sources\Policies;

use App\Modules\Admin\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SourcePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user)
    {
        return $user->canDo(['view']);
    }

    public function delete(User $user)
    {
        return $user->canDo(['delete']);
    }
}
