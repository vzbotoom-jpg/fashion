<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->role === RoleEnum::SUPER_ADMIN->value) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }

    public function view(User $user, User $model)
    {
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }

    public function create(User $user)
    {
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }

    public function update(User $user, User $model)
    {
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }

    public function delete(User $user, User $model)
    {
        if ($model->role === RoleEnum::SUPER_ADMIN->value) {
            $superAdminCount = User::where('role', RoleEnum::SUPER_ADMIN->value)->count();
            return $superAdminCount > 1;
        }
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }

    public function assignRole(User $user)
    {
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }
}