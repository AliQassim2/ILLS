<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\questions>
 */
class QuestionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence,
            'stories_id' => \App\Models\stories::factory(),
            'correct_answer' => $this->faker->sentence,
            'answer1' => fake()->sentence,
            'answer2' => fake()->sentence,
            'answer3' => fake()->sentence,
            'likes' => $this->faker->numberBetween(0, 100),
        ];
    }
}
