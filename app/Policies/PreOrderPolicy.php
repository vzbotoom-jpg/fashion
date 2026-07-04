<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PreOrder;
use App\Enums\RoleEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class PreOrderPolicy
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
        return in_array($user->role, [
            RoleEnum::SUPER_ADMIN->value,
            RoleEnum::ADMIN->value,
            RoleEnum::CUSTOMER->value
        ]);
    }

    public function view(User $user, PreOrder $preOrder)
    {
        if (in_array($user->role, [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value])) {
            return true;
        }

        return $user->id === $preOrder->user_id;
    }

    public function create(User $user)
    {
        return $user->role === RoleEnum::CUSTOMER->value;
    }

    public function update(User $user, PreOrder $preOrder)
    {
        return in_array($user->role, [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value]);
    }

    public function delete(User $user, PreOrder $preOrder)
    {
        return in_array($user->role, [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value]);
    }

    public function process(User $user)
    {
        return in_array($user->role, [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value]);
    }
}