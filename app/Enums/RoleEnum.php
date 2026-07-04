<?php

namespace App\Enums;

enum RoleEnum: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case CUSTOMER = 'customer';

    /**
     * Get all role labels
     */
    public function label(): string
    {
        return match($this) {
            self::SUPER_ADMIN => 'Super Administrator',
            self::ADMIN => 'Administrator',
            self::CUSTOMER => 'Customer',
        };
    }

    /**
     * Get role permissions
     */
    public function permissions(): array
    {
        return match($this) {
            self::SUPER_ADMIN => ['*'],
            self::ADMIN => [
                'manage_products',
                'manage_collections',
                'manage_categories',
                'manage_pre_orders',
                'manage_custom_orders',
                'manage_gallery',
                'manage_testimonials',
                'view_messages',
                'manage_stock',
                'view_reports',
            ],
            self::CUSTOMER => [
                'view_products',
                'view_collections',
                'view_gallery',
                'create_pre_order',
                'create_custom_order',
                'view_own_orders',
                'manage_cart',
                'checkout',
                'manage_profile',
            ],
        };
    }

    /**
     * Check if role has permission
     */
    public function hasPermission(string $permission): bool
    {
        $permissions = $this->permissions();
        return in_array('*', $permissions) || in_array($permission, $permissions);
    }

    /**
     * Get all roles as array for select
     */
    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($role) => [
            $role->value => $role->label()
        ])->toArray();
    }
}