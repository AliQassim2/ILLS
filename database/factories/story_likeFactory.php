<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\story_like>
 */
class story_likeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'like' => $this->faker->numberBetween(-1, 1),
            'stories_id' => \App\Models\stories::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
