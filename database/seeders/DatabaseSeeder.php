<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create();
        // \App\Models\stories::factory()->create();
        // \App\Models\story_comment::factory(5)->create();
        // \App\Models\story_like::factory(5)->create();
        \App\Models\questions::factory(50)->create([
            'stories_id' => 10

        ]);
        // \App\Models\question_comment::factory(5)->create();
        // \App\Models\question_like::factory(5)->create();
        // \App\Models\result::factory(5)->create();
        // \App\Models\favorite::factory(5)->create();
        \App\Models\story_like::factory(15)->create([
            'stories_id' => 1,
            'user_id' => 4,
            'like' => 1
        ]);
        // \App\Models\story_comment::factory(15)->create([
        //     'stories_id' => 1,
        //     'user_id' => 4
        // ]);
    }
}
