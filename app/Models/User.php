<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\RoleEnum;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'city',
        'province',
        'postal_code',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function preOrders()
    {
        return $this->hasMany(PreOrder::class);
    }

    public function customOrders()
    {
        return $this->hasMany(CustomOrder::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class);
    }

    // Helper methods
    public function isSuperAdmin(): bool
    {
        return $this->role === RoleEnum::SUPER_ADMIN->value;
    }

    public function isAdmin(): bool
    {
        return $this->role === RoleEnum::ADMIN->value;
    }

    public function isCustomer(): bool
    {
        return $this->role === RoleEnum::CUSTOMER->value;
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function hasPermission(string $permission): bool
    {
        $roleEnum = RoleEnum::tryFrom($this->role);
        if (!$roleEnum) {
            return false;
        }
        return $roleEnum->hasPermission($permission);
    }

    public function getRoleLabelAttribute(): string
    {
        $roleEnum = RoleEnum::tryFrom($this->role);
        return $roleEnum ? $roleEnum->label() : $this->role;
    }

    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([
            $this->address,
            $this->city,
            $this->province,
            $this->postal_code,
        ]);
        return implode(', ', $parts);
    }
}