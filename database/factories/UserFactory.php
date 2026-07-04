<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Default password untuk testing
            'role' => 'customer', // Default role
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'province' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'is_active' => true,
            'remember_token' => Str::random(10),
            'last_login_at' => $this->faker->optional(0.7)->dateTimeThisYear(),
        ];
    }

    /**
     * Indicate that the user is a Super Admin.
     */
    public function superAdmin(): static
    {
        return $this->state([
            'role' => 'super_admin',
            'name' => 'Super Admin ' . $this->faker->firstName(),
        ]);
    }

    /**
     * Indicate that the user is an Admin.
     */
    public function admin(): static
    {
        return $this->state([
            'role' => 'admin',
            'name' => 'Admin ' . $this->faker->firstName(),
        ]);
    }

    /**
     * Indicate that the user is a Customer.
     */
    public function customer(): static
    {
        return $this->state([
            'role' => 'customer',
        ]);
    }

    /**
     * Indicate that the user is inactive.
     */
    public function inactive(): static
    {
        return $this->state([
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the user's email is not verified.
     */
    public function unverified(): static
    {
        return $this->state([
            'email_verified_at' => null,
        ]);
    }

    /**
     * Set specific role.
     */
    public function withRole(string $role): static
    {
        return $this->state([
            'role' => $role,
        ]);
    }

    /**
     * Set specific city.
     */
    public function inCity(string $city): static
    {
        return $this->state([
            'city' => $city,
        ]);
    }

    /**
     * Set specific province.
     */
    public function inProvince(string $province): static
    {
        return $this->state([
            'province' => $province,
        ]);
    }
}