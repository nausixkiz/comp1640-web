<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(25),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['published', 'in_published']),
            'is_default' => $this->faker->boolean,
        ];
    }
}
