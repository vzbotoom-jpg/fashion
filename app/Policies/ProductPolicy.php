<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use App\Enums\RoleEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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
        return in_array($user->role, [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value]);
    }

    public function view(User $user, Product $product)
    {
        return in_array($user->role, [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value]);
    }

    public function create(User $user)
    {
        return in_array($user->role, [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value]);
    }

    public function update(User $user, Product $product)
    {
        return in_array($user->role, [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value]);
    }

    public function delete(User $user, Product $product)
    {
        return in_array($user->role, [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value]);
    }

    public function manageStock(User $user)
    {
        return in_array($user->role, [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value]);
    }
}