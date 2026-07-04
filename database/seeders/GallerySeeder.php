<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $images = [
            [
                'title' => 'Summer Fashion 2024',
                'description' => 'Koleksi fashion musim panas dengan gaya segar',
                'category' => 'seasonal',
                'order' => 1,
            ],
            [
                'title' => 'Urban Street Style',
                'description' => 'Gaya urban streetwear untuk anak muda',
                'category' => 'streetwear',
                'order' => 2,
            ],
            [
                'title' => 'Elegant Evening Wear',
                'description' => 'Busana elegan untuk acara malam',
                'category' => 'evening',
                'order' => 3,
            ],
            [
                'title' => 'Sustainable Fashion',
                'description' => 'Fashion ramah lingkungan dengan bahan organik',
                'category' => 'sustainable',
                'order' => 4,
            ],
            [
                'title' => 'Classic Collection',
                'description' => 'Koleksi klasik yang timeless',
                'category' => 'classic',
                'order' => 5,
            ],
        ];

        foreach ($images as $image) {
            Gallery::updateOrCreate(
                [
                    'title' => $image['title'],
                ],
                array_merge($image, [
                    'image_path' => 'gallery/sample-' . rand(1, 10) . '.jpg',
                    'is_active' => true,
                ])
            );
        }
    }
}