<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'contents' => $this->faker->paragraph(),
            'like_count' => $this->faker->numberBetween(0, 100),
            'dislike_count' => $this->faker->numberBetween(0, 100),
        ];
    }
}
