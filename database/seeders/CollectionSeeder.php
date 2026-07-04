<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    public function run()
    {
        $collections = [
            [
                'name' => 'Summer Collection 2024',
                'slug' => 'summer-collection-2024',
                'description' => 'Koleksi musim panas 2024 dengan desain segar dan warna cerah',
                'is_active' => true,
            ],
            [
                'name' => 'Urban Streetwear',
                'slug' => 'urban-streetwear',
                'description' => 'Gaya urban streetwear untuk tampilan masa kini',
                'is_active' => true,
            ],
            [
                'name' => 'Classic Elegance',
                'slug' => 'classic-elegance',
                'description' => 'Koleksi elegan klasik yang tak lekang oleh waktu',
                'is_active' => true,
            ],
            [
                'name' => 'Sustainable Fashion',
                'slug' => 'sustainable-fashion',
                'description' => 'Fashion ramah lingkungan dengan bahan berkualitas',
                'is_active' => true,
            ],
            [
                'name' => 'Limited Edition',
                'slug' => 'limited-edition',
                'description' => 'Edisi terbatas untuk kolektor fashion',
                'is_active' => true,
            ],
        ];

        foreach ($collections as $collection) {
            Collection::updateOrCreate(
                ['slug' => $collection['slug']],
                $collection
            );
        }
    }
}