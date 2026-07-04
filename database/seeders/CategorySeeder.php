<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Kaos',
                'slug' => 'kaos',
                'description' => 'Koleksi kaos fashion terkini',
                'is_active' => true,
            ],
            [
                'name' => 'Kemeja',
                'slug' => 'kemeja',
                'description' => 'Kemeja formal dan casual',
                'is_active' => true,
            ],
            [
                'name' => 'Jaket',
                'slug' => 'jaket',
                'description' => 'Jaket untuk segala musim',
                'is_active' => true,
            ],
            [
                'name' => 'Celana',
                'slug' => 'celana',
                'description' => 'Celana panjang dan pendek',
                'is_active' => true,
            ],
            [
                'name' => 'Rok',
                'slug' => 'rok',
                'description' => 'Rok modern dan elegan',
                'is_active' => true,
            ],
            [
                'name' => 'Gaun',
                'slug' => 'gaun',
                'description' => 'Gaun untuk berbagai acara',
                'is_active' => true,
            ],
            [
                'name' => 'Aksesoris',
                'slug' => 'aksesoris',
                'description' => 'Aksesoris fashion pelengkap',
                'is_active' => true,
            ],
            [
                'name' => 'Sepatu',
                'slug' => 'sepatu',
                'description' => 'Koleksi sepatu trendi',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        // Create subcategories
        $subcategories = [
            ['name' => 'Kaos Polos', 'slug' => 'kaos-polos', 'parent' => 'kaos'],
            ['name' => 'Kaos Grafis', 'slug' => 'kaos-grafis', 'parent' => 'kaos'],
            ['name' => 'Kemeja Formal', 'slug' => 'kemeja-formal', 'parent' => 'kemeja'],
            ['name' => 'Kemeja Casual', 'slug' => 'kemeja-casual', 'parent' => 'kemeja'],
            ['name' => 'Jaket Hoodie', 'slug' => 'jaket-hoodie', 'parent' => 'jaket'],
            ['name' => 'Jaket Denim', 'slug' => 'jaket-denim', 'parent' => 'jaket'],
            ['name' => 'Celana Jeans', 'slug' => 'celana-jeans', 'parent' => 'celana'],
            ['name' => 'Celana Chino', 'slug' => 'celana-chino', 'parent' => 'celana'],
        ];

        foreach ($subcategories as $sub) {
            $parent = Category::where('slug', $sub['parent'])->first();
            if ($parent) {
                Category::updateOrCreate(
                    ['slug' => $sub['slug']],
                    [
                        'name' => $sub['name'],
                        'description' => 'Subkategori ' . $sub['name'],
                        'parent_id' => $parent->id,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}