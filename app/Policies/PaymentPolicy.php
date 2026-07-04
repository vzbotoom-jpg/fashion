<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payment;
use App\Enums\RoleEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
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

    public function view(User $user, Payment $payment)
    {
        return in_array($user->role, [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value]);
    }

    public function verify(User $user)
    {
        return in_array($user->role, [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value]);
    }

    public function refund(User $user)
    {
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }

    public function void(User $user)
    {
        return $user->role === RoleEnum::SUPER_ADMIN->value;
    }
}