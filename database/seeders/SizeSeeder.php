<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    public function run()
    {
        $sizes = [
            ['name' => 'Extra Small', 'code' => 'XS', 'description' => 'Extra Small', 'order' => 1],
            ['name' => 'Small', 'code' => 'S', 'description' => 'Small', 'order' => 2],
            ['name' => 'Medium', 'code' => 'M', 'description' => 'Medium', 'order' => 3],
            ['name' => 'Large', 'code' => 'L', 'description' => 'Large', 'order' => 4],
            ['name' => 'Extra Large', 'code' => 'XL', 'description' => 'Extra Large', 'order' => 5],
            ['name' => 'XXL', 'code' => 'XXL', 'description' => 'Double Extra Large', 'order' => 6],
            ['name' => 'Custom', 'code' => 'CUSTOM', 'description' => 'Custom Size', 'order' => 7],
        ];

        foreach ($sizes as $size) {
            Size::updateOrCreate(
                ['code' => $size['code']],
                $size
            );
        }
    }
}