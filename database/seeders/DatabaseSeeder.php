<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hanya panggil seeder yang diperlukan
        // UserSeeder TIDAK dipanggil karena user sudah dibuat via Tinker
        $this->call([
            SizeSeeder::class,        // Ukuran produk
            CategorySeeder::class,    // Kategori produk
            CollectionSeeder::class,  // Koleksi produk
            SettingSeeder::class,     // Pengaturan sistem
            // ProductSeeder::class,  // Opsional, bisa via Tinker juga
            // GallerySeeder::class,  // Opsional
            // TestimonialSeeder::class, // Opsional
        ]);

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📝 Users already created via Tinker');
        $this->command->info('👑 Super Admin: superadmin@example.com / password');
        $this->command->info('👤 Admin: admin@example.com / password');
        $this->command->info('👥 Customers: andi@example.com, siti@example.com, budi@example.com / password');
    }
}