<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\question_like>
 */
class question_likeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'like' => $this->faker->boolean,
            'questions_id' => \App\Models\questions::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
