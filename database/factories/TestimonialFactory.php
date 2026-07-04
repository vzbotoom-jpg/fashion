<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition()
    {
        return [
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->email(),
            'customer_avatar' => null,
            'content' => $this->faker->paragraph(2),
            'rating' => $this->faker->numberBetween(3, 5),
            'is_active' => true,
        ];
    }

    public function inactive()
    {
        return $this->state([
            'is_active' => false,
        ]);
    }

    public function highRating()
    {
        return $this->state([
            'rating' => $this->faker->numberBetween(4, 5),
        ]);
    }

    public function lowRating()
    {
        return $this->state([
            'rating' => $this->faker->numberBetween(1, 3),
        ]);
    }

    public function withUser($userId)
    {
        return $this->state([
            'user_id' => $userId,
        ]);
    }

    public function withAvatar()
    {
        return $this->state([
            'customer_avatar' => 'testimonials/' . $this->faker->image('public/storage/testimonials', 200, 200, null, false),
        ]);
    }
}