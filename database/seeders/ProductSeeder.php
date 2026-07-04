<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::pluck('id', 'slug')->toArray();
        $collections = Collection::pluck('id', 'slug')->toArray();
        $sizes = Size::pluck('id', 'code')->toArray();

        $products = [
            [
                'name' => 'Kaos Polos Premium',
                'slug' => 'kaos-polos-premium',
                'sku' => 'KPP-001',
                'description' => 'Kaos polos premium dengan bahan katun 100% yang nyaman dipakai sehari-hari.',
                'price' => 150000,
                'category' => 'kaos-polos',
                'collection' => 'summer-collection-2024',
                'is_featured' => true,
                'sizes' => ['S' => 20, 'M' => 30, 'L' => 25, 'XL' => 15],
            ],
            [
                'name' => 'Kemeja Formal Putih',
                'slug' => 'kemeja-formal-putih',
                'sku' => 'KFP-001',
                'description' => 'Kemeja formal putih dengan potongan slim fit untuk tampilan profesional.',
                'price' => 250000,
                'category' => 'kemeja-formal',
                'collection' => 'classic-elegance',
                'is_featured' => true,
                'sizes' => ['S' => 15, 'M' => 20, 'L' => 18, 'XL' => 10],
            ],
            [
                'name' => 'Jaket Hoodie Grafis',
                'slug' => 'jaket-hoodie-grafis',
                'sku' => 'JHG-001',
                'description' => 'Jaket hoodie dengan desain grafis eksklusif dan bahan fleece yang hangat.',
                'price' => 350000,
                'category' => 'jaket-hoodie',
                'collection' => 'urban-streetwear',
                'is_featured' => false,
                'sizes' => ['S' => 10, 'M' => 15, 'L' => 12, 'XL' => 8],
            ],
            [
                'name' => 'Celana Jeans Slim',
                'slug' => 'celana-jeans-slim',
                'sku' => 'CJS-001',
                'description' => 'Celana jeans slim fit dengan bahan denim berkualitas tinggi.',
                'price' => 300000,
                'category' => 'celana-jeans',
                'collection' => 'sustainable-fashion',
                'is_featured' => true,
                'sizes' => ['S' => 12, 'M' => 18, 'L' => 15, 'XL' => 10],
            ],
            [
                'name' => 'Gaun Midi Floral',
                'slug' => 'gaun-midi-floral',
                'sku' => 'GMF-001',
                'description' => 'Gaun midi dengan motif floral yang elegan untuk berbagai acara.',
                'price' => 450000,
                'category' => 'gaun',
                'collection' => 'summer-collection-2024',
                'is_featured' => false,
                'sizes' => ['S' => 8, 'M' => 12, 'L' => 10, 'XL' => 5],
            ],
            [
                'name' => 'Rok A-line Batik',
                'slug' => 'rok-a-line-batik',
                'sku' => 'RAB-001',
                'description' => 'Rok A-line dengan motif batik modern yang memukau.',
                'price' => 280000,
                'category' => 'rok',
                'collection' => 'sustainable-fashion',
                'is_featured' => false,
                'sizes' => ['S' => 10, 'M' => 15, 'L' => 12, 'XL' => 8],
            ],
        ];

        foreach ($products as $productData) {
            $categoryId = $categories[$productData['category']] ?? null;
            $collectionId = $collections[$productData['collection']] ?? null;

            $product = Product::updateOrCreate(
                ['sku' => $productData['sku']],
                [
                    'name' => $productData['name'],
                    'slug' => $productData['slug'],
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'category_id' => $categoryId,
                    'collection_id' => $collectionId,
                    'is_featured' => $productData['is_featured'],
                    'is_active' => true,
                ]
            );

            // Add sizes
            foreach ($productData['sizes'] as $sizeCode => $stock) {
                $sizeId = $sizes[$sizeCode] ?? null;
                if ($sizeId) {
                    ProductSize::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'size_id' => $sizeId,
                        ],
                        [
                            'stock' => $stock,
                            'min_stock' => 5,
                            'price' => $productData['price'],
                        ]
                    );
                }
            }

            // Add sample images
            $images = [
                ['order' => 0, 'is_primary' => true],
                ['order' => 1, 'is_primary' => false],
            ];

            foreach ($images as $imageData) {
                ProductImage::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'order' => $imageData['order'],
                    ],
                    [
                        'image_path' => 'products/sample-' . $product->id . '-' . $imageData['order'] . '.jpg',
                        'is_primary' => $imageData['is_primary'],
                    ]
                );
            }
        }
    }
}