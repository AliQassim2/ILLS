<?php

namespace Database\Factories;

use app\Models\question_comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\question_comment>
 */
class question_commentFactory extends Factory
{
    protected $model = question_comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => $this->faker->sentence,
            'questions_id' => \App\Models\questions::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
