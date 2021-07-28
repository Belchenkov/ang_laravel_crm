<?php

namespace App\Modules\Admin\TaskComment\Policies;

use App\Modules\Admin\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskCommentPolicy
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

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->canDo(['view']);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool
    {
        return $user->canDo(['create']);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function edit(User $user): bool
    {
        return $user->canDo(['create']);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->canDo(['create']);
    }
}
