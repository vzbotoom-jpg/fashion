<?php

namespace Database\Factories;

use App\Models\PreOrder;
use App\Models\User;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreOrderFactory extends Factory
{
    protected $model = PreOrder::class;

    public function definition()
    {
        $statuses = ['pending', 'processing', 'production', 'shipped', 'completed', 'cancelled'];
        $status = $this->faker->randomElement($statuses);
        
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'size_id' => Size::factory(),
            'order_number' => 'PO-' . now()->format('Ymd') . '-' . strtoupper($this->faker->unique()->lexify('??????')),
            'quantity' => $this->faker->numberBetween(1, 5),
            'shipping_address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'notes' => $this->faker->optional()->sentence(),
            'status' => $status,
            'admin_notes' => $this->faker->optional()->sentence(),
            'estimated_completion_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'completed_at' => $status === 'completed' ? $this->faker->dateTimeBetween('-1 week', 'now') : null,
        ];
    }

    public function pending()
    {
        return $this->state([
            'status' => 'pending',
        ]);
    }

    public function processing()
    {
        return $this->state([
            'status' => 'processing',
        ]);
    }

    public function completed()
    {
        return $this->state([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    }

    public function cancelled()
    {
        return $this->state([
            'status' => 'cancelled',
        ]);
    }

    public function withUser($userId)
    {
        return $this->state([
            'user_id' => $userId,
        ]);
    }

    public function withProduct($productId)
    {
        return $this->state([
            'product_id' => $productId,
        ]);
    }

    public function withSize($sizeId)
    {
        return $this->state([
            'size_id' => $sizeId,
        ]);
    }
}