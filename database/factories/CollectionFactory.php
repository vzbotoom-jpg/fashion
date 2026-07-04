<?php

namespace Database\Factories;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CollectionFactory extends Factory
{
    protected $model = Collection::class;

    public function definition()
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'image_path' => null,
            'is_active' => true,
        ];
    }

    public function inactive()
    {
        return $this->state([
            'is_active' => false,
        ]);
    }

    public function withImage()
    {
        return $this->state([
            'image_path' => 'collections/' . $this->faker->image('public/storage/collections', 640, 480, null, false),
        ]);
    }
}