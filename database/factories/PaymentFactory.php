<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        $methods = ['bank_transfer', 'credit_card', 'e_wallet'];
        $statuses = ['pending', 'completed', 'failed', 'cancelled', 'refunded'];
        
        return [
            'payable_type' => Order::class,
            'payable_id' => Order::factory(),
            'order_id' => Order::factory(),
            'amount' => $this->faker->randomFloat(2, 100000, 1000000),
            'payment_method' => $this->faker->randomElement($methods),
            'payment_channel' => null,
            'transaction_id' => $this->faker->optional()->uuid(),
            'payment_code' => 'PM-' . now()->format('Ymd') . '-' . strtoupper($this->faker->unique()->lexify('??????')),
            'status' => $this->faker->randomElement($statuses),
            'paid_at' => null,
            'expired_at' => now()->addHours(24),
            'payment_proof' => null,
            'notes' => $this->faker->optional()->sentence(),
        ];
    }

    public function pending()
    {
        return $this->state([
            'status' => 'pending',
        ]);
    }

    public function completed()
    {
        return $this->state([
            'status' => 'completed',
            'paid_at' => now(),
        ]);
    }

    public function failed()
    {
        return $this->state([
            'status' => 'failed',
        ]);
    }

    public function refunded()
    {
        return $this->state([
            'status' => 'refunded',
        ]);
    }

    public function withOrder($orderId)
    {
        return $this->state([
            'order_id' => $orderId,
            'payable_id' => $orderId,
        ]);
    }

    public function withMethod($method)
    {
        return $this->state([
            'payment_method' => $method,
        ]);
    }

    public function withProof()
    {
        return $this->state([
            'payment_proof' => 'payments/' . $this->faker->image('public/storage/payments', 500, 500, null, false),
        ]);
    }
}