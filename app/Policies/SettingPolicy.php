<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }

    public function update(User $user)
    {
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }

    public function managePayment(User $user)
    {
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }

    public function manageShipping(User $user)
    {
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }

    public function manageGeneral(User $user)
    {
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }
}