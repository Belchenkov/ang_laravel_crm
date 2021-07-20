<?php

namespace App\Modules\Admin\Lead\Policies;

use App\Modules\Admin\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadPolicy
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

    public function create(User $user)
    {
        return $user->canDo(['create']);
    }

    public function edit(User $user)
    {
        return $user->canDo(['edit']);
    }

    public function delete(User $user)
    {
        return $user->canDo(['delete']);
    }
}
