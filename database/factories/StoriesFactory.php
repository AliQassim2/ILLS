<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\stories>
 */
class StoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => $this->faker->text(),
            'title' => $this->faker->sentence(),
            'media' => $this->faker->imageUrl(),
            'type' => $this->faker->numberBetween(1, 3),
            'is_active' => $this->faker->boolean(),
            'views' => $this->faker->numberBetween(0, 1000),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
