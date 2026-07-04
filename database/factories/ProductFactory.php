<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'sku' => 'PRD-' . strtoupper(Str::random(8)),
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 100000, 1000000),
            'category_id' => Category::factory(),
            'collection_id' => Collection::factory(),
            'is_featured' => $this->faker->boolean(20),
            'is_active' => true,
        ];
    }

    public function featured()
    {
        return $this->state([
            'is_featured' => true,
        ]);
    }

    public function inactive()
    {
        return $this->state([
            'is_active' => false,
        ]);
    }

    public function withCategory($categoryId)
    {
        return $this->state([
            'category_id' => $categoryId,
        ]);
    }

    public function withCollection($collectionId)
    {
        return $this->state([
            'collection_id' => $collectionId,
        ]);
    }
}