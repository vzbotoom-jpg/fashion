<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    public function definition()
    {
        $categories = ['seasonal', 'streetwear', 'evening', 'sustainable', 'classic'];
        
        return [
            'image_path' => 'gallery/' . $this->faker->image('public/storage/gallery', 800, 600, null, false),
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'category' => $this->faker->randomElement($categories),
            'order' => $this->faker->numberBetween(1, 100),
            'is_active' => true,
        ];
    }

    public function inactive()
    {
        return $this->state([
            'is_active' => false,
        ]);
    }

    public function withCategory($category)
    {
        return $this->state([
            'category' => $category,
        ]);
    }
}