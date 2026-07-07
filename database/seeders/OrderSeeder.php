<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $user = User::first();

        for ($i = 0; $i < 30; $i++) {
            Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'grand_total' => $faker->numberBetween(100000, 5000000),
                'status' => 'completed',
                'shipping_address' => $faker->address,
                'city' => $faker->city,
                'province' => $faker->state,
                'postal_code' => $faker->postcode,
                'phone' => $faker->phoneNumber,
                'payment_method' => 'bank_transfer',
                'payment_status' => 'paid',
                'shipping_cost' => $faker->numberBetween(10000, 50000),
                'tax' => 0,
                'discount' => 0,
                'created_at' => $faker->dateTimeBetween('-30 days', 'now'),
            ]);
        }
    }
}