<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    public function run()
    {
        // This seeder is just for reference, actual order statuses are created dynamically
        // when orders are created. This seeder can be empty or used for initial status data.
        
        // You can add default status descriptions here if needed
        $this->command->info('Order status seeder completed. Statuses are created dynamically.');
    }
}