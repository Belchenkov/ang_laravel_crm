<?php


namespace App\Modules\Admin\User\Services;


use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\User\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @return array
     */
    public function getUsers($status = false)
    {
        $usersBuilder = User::with('roles');

        if ($status) {
            $usersBuilder->where('status', $status);
        }

        $users = $usersBuilder->get();

        $users->transform(function ($user) {
            $user->role_name = '';

            if (isset($user->roles)) {
                $user->role_name = $user->roles->first()->title ?? '';
            }

            return $user;
        });

        return $users;
    }

    /**
     * @param UserRequest $request
     * @param User $user
     * @return User
     */
    public function save(UserRequest $request, User $user): User
    {
        $user->fill($request->only($user->getFillable()));
        $user->password = Hash::make($request->password);
        $user->status = '1';
        $user->save();

        $role = Role::findOrFail($request->role_id);
        $user->roles()->sync($role->id);

        $user->role_name = $role->title;

        return $user;
    }
}
