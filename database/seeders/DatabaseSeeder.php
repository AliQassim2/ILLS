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
        // \App\Models\questions::factory(50)->create([
        //     'stories_id' => 10

        // ]);
        // \App\Models\question_comment::factory(5)->create();
        // \App\Models\question_like::factory(5)->create();
        // \App\Models\result::factory(5)->create();
        // \App\Models\favorite::factory(5)->create();
        // \App\Models\story_like::factory(15)->create([
        //     'stories_id' => 1,
        //     'user_id' => 4,
        //     'like' => 1
        // ]);
        // \App\Models\story_comment::factory(15)->create([
        //     'stories_id' => 1,
        //     'user_id' => 4
        // ]);
        \App\Models\User::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => bcrypt('admin'),
            'roll' => 0,

        ]);
        \App\Models\stories::create([
            'id' => 1,
            'body' => 'Lina was walking in the park when she saw a small puppy shivering under a bench. She looked around, but no one seemed to be looking for it. She picked it up and took it to the nearest vet. Luckily, the puppy had a tag, and soon it was reunited with its owner.',
            'title' => 'The Lost Puppy',
            'user_id' => 1,
        ]);
        \App\Models\stories::create([
            'id' => 2,
            'body' => 'Ali was playing football inside the house even though his mother told him not to. The ball hit a vase and broke it. When his mother came in, he admitted his mistake and apologized.',
            'title' => 'The Broken Vase',
            'user_id' => 1,
        ]);
        \App\Models\stories::create([
            'id' => 3,
            'body' => 'One evening, the power went out in Anya’s neighborhood. Instead of being upset, her family lit candles and played board games together. They ended up having a lot of fun.',
            'title' => 'A Day Without Electricity',
            'user_id' => 1,
        ]);
        \App\Models\stories::create([
            'id' => 4,
            'body' => 'The students visited the zoo on their school trip. They saw lions, elephants, and monkeys. Everyone enjoyed the day and learned a lot about animals.',
            'title' => 'The School Trip',
            'user_id' => 1,
        ]);
        \App\Models\stories::create([
            'id' => 5,
            'body' => 'Ravi found an old pen in the attic. When he wrote with it, the words came true! He used it to help people around him. But he was careful not to be greedy.',
            'title' => 'The Magic Pen',
            'user_id' => 1,
        ]);
        \App\Models\stories::create([
            'id' => 6,
            'body' => 'It started raining heavily just as Maya was walking to school. She had no umbrella, but her friend stopped to share hers. They both reached school wet but happy.',
            'title' => 'The Rainy Day',
            'user_id' => 1,
        ]);
        \App\Models\stories::create([
            'id' => 7,
            'body' => 'Jake forgot his homework at home. Instead of lying, he told the teacher the truth. The teacher appreciated his honesty and let him submit it the next day.',
            'title' => 'The Missing Homework',
            'user_id' => 1,
        ]);
        \App\Models\stories::create([
            'id' => 8,
            'body' => 'A little girl saw a kitten stuck in a tree. While others watched, she climbed up carefully and rescued it. Everyone clapped for her bravery.',
            'title' => 'The Brave Little Girl',
            'user_id' => 1,
        ]);
        \App\Models\stories::create([
            'id' => 9,
            'body' => 'Sara baked cookies for her brother’s birthday. He was surprised and happy because she did it all by herself for the first time.',
            'title' => 'The Surprise Gift',
            'user_id' => 1,
        ]);
        \App\Models\stories::create([
            'id' => 10,
            'body' => 'A new student joined Rami’s class. He looked shy and nervous. Rami went to him, introduced himself, and became his first friend.',
            'title' => 'The New Student',
            'user_id' => 1,
        ]);
        \App\Models\questions::create([
            'question' => 'What did Lina do when she found the puppy?',
            'correct_answer' => 'She took it to the vet',
            'answer1' => 'She ignored it',
            'answer2' => 'She took it home',
            'answer3' => 'She left it there',
            'stories_id' => 1,
        ]);
        \App\Models\questions::create([
            'question' => 'Where did Lina find the puppy?',
            'correct_answer' => 'Under a bench',
            'answer1' => 'Inside a store',
            'answer2' => 'Near a car',
            'answer3' => 'In her backyard',
            'stories_id' => 1,
        ]);
        \App\Models\questions::create([
            'question' => 'How was the puppy returned to its owner?',
            'correct_answer' => 'It had a tag',
            'answer1' => 'Lina posted online',
            'answer2' => 'The vet kept it',
            'answer3' => 'Someone recognized it',
            'stories_id' => 1,
        ]);
        \App\Models\questions::create([
            'question' => 'What did Ali do after breaking the vase?',
            'correct_answer' => '',
            'answer1' => 'Hid it',
            'answer2' => 'Blamed his brother',
            'answer3' => '',
            'stories_id' => 2,
        ]);
        \App\Models\questions::create([
            'question' => 'What caused the vase to break?',
            'correct_answer' => 'Football hit it',
            'answer1' => 'Earthquake',
            'answer2' => 'It fell off by itself',
            'answer3' => 'Someone pushed it',
            'stories_id' => 2,
        ]);
        \App\Models\questions::create([
            'question' => 'What did Ali’s mother do?',
            'correct_answer' => 'Appreciated his honesty',
            'answer1' => 'Got very angry',
            'answer2' => 'Ignored it',
            'answer3' => 'Called his father',
            'stories_id' => 2,
        ]);

        \App\Models\questions::create([
            'question' => 'What did Anya’s family do during the power cut?',
            'correct_answer' => 'Played board games',
            'answer1' => 'Went to sleep',
            'answer2' => 'Watched TV',
            'answer3' => 'Went outside',
            'stories_id' => 3,
        ]);
        \App\Models\questions::create([
            'question' => 'What did they use for light?',
            'correct_answer' => 'Candles',
            'answer1' => 'Lamps',
            'answer2' => 'Flashlights',
            'answer3' => 'Phones',
            'stories_id' => 3,
        ]);
        \App\Models\questions::create([
            'question' => 'How did the family feel by the end?',
            'correct_answer' => 'Happy',
            'answer1' => 'Bored',
            'answer2' => 'Scared',
            'answer3' => 'Angry',
            'stories_id' => 3,
        ]);

        \App\Models\questions::create([
            'question' => 'Where did the students go?',
            'correct_answer' => 'Zoo',
            'answer1' => 'Library',
            'answer2' => 'Museum',
            'answer3' => 'Beach',
            'stories_id' => 4,
        ]);
        \App\Models\questions::create([
            'question' => 'What animals did they see?',
            'correct_answer' => 'Lions, elephants, and monkeys',
            'answer1' => 'Only birds',
            'answer2' => 'Dogs and cats',
            'answer3' => 'Just fish',
            'stories_id' => 4,
        ]);
        \App\Models\questions::create([
            'question' => 'What was the purpose of the trip?',
            'correct_answer' => 'To learn about animals',
            'answer1' => 'To play games',
            'answer2' => 'To study math',
            'answer3' => 'To eat at a restaurant',
            'stories_id' => 4,
        ]);
        \App\Models\questions::create([
            'question' => 'What did Ravi find in the attic?',
            'correct_answer' => 'An old pen',
            'answer1' => 'A book',
            'answer2' => 'A coin',
            'answer3' => 'A box',
            'stories_id' => 5,
        ]);
        \App\Models\questions::create([
            'question' => 'What happened when Ravi used the pen?',
            'correct_answer' => 'The words came true',
            'answer1' => 'The pen disappeared',
            'answer2' => 'It broke',
            'answer3' => 'Nothing happened',
            'stories_id' => 5,
        ]);
        \App\Models\questions::create([
            'question' => 'What did Ravi use the pen for?',
            'correct_answer' => 'To help people',
            'answer1' => 'To play games',
            'answer2' => 'To become rich',
            'answer3' => 'To do his homework',
            'stories_id' => 5,
        ]);

        \App\Models\questions::create([
            'question' => 'What happened when Maya was walking to school?',
            'correct_answer' => 'It started raining',
            'answer1' => 'She saw a rainbow',
            'answer2' => 'She lost her bag',
            'answer3' => 'She got lost',
            'stories_id' => 6,
        ]);
        \App\Models\questions::create([
            'question' => 'Who helped Maya?',
            'correct_answer' => 'Her friend',
            'answer1' => 'A teacher',
            'answer2' => 'Her mother',
            'answer3' => 'A stranger',
            'stories_id' => 6,
        ]);
        \App\Models\questions::create([
            'question' => 'How did they feel at school?',
            'correct_answer' => 'Wet but happy',
            'answer1' => 'Angry',
            'answer2' => 'Sad',
            'answer3' => 'Tired',
            'stories_id' => 6,
        ]);

        \App\Models\questions::create([
            'question' => 'What did Jake forget?',
            'correct_answer' => 'His homework',
            'answer1' => 'His lunch',
            'answer2' => 'His books',
            'answer3' => 'His shoes',
            'stories_id' => 7,
        ]);
        \App\Models\questions::create([
            'question' => 'What did Jake do?',
            'correct_answer' => 'Told the truth',
            'answer1' => 'Made an excuse',
            'answer2' => 'Skipped class',
            'answer3' => 'Asked a friend for help',
            'stories_id' => 7,
        ]);
        \App\Models\questions::create([
            'question' => 'What did the teacher do?',
            'correct_answer' => 'Let him submit it the next day',
            'answer1' => 'Gave him detention',
            'answer2' => 'Called his parents',
            'answer3' => 'Tore his notebook',
            'stories_id' => 7,
        ]);

        \App\Models\questions::create([
            'question' => 'What was stuck in the tree?',
            'correct_answer' => 'A kitten',
            'answer1' => 'A bird',
            'answer2' => 'A balloon',
            'answer3' => 'A squirrel',
            'stories_id' => 8,
        ]);
        \App\Models\questions::create([
            'question' => 'Who rescued the kitten?',
            'correct_answer' => 'A little girl',
            'answer1' => 'A firefighter',
            'answer2' => 'Her brother',
            'answer3' => 'Her teacher',
            'stories_id' => 8,
        ]);
        \App\Models\questions::create([
            'question' => 'How did the people react?',
            'correct_answer' => 'They clapped',
            'answer1' => 'They laughed',
            'answer2' => 'They ran away',
            'answer3' => 'They scolded her',
            'stories_id' => 8,
        ]);

        \App\Models\questions::create([
            'question' => 'What did Sara bake?',
            'correct_answer' => 'Cookies',
            'answer1' => 'Cake',
            'answer2' => 'Bread',
            'answer3' => 'Pizza',
            'stories_id' => 9,
        ]);
        \App\Models\questions::create([
            'question' => 'For whom did she bake the gift?',
            'correct_answer' => 'Her brother',
            'answer1' => 'Her friend',
            'answer2' => 'Her teacher',
            'answer3' => 'Her mother',
            'stories_id' => 9,
        ]);
        \App\Models\questions::create([
            'question' => 'How did her brother feel?',
            'correct_answer' => 'Surprised and happy',
            'answer1' => 'Angry',
            'answer2' => 'Sad',
            'answer3' => 'Confused',
            'stories_id' => 9,
        ]);

        \App\Models\questions::create([
            'question' => 'Who joined Rami’s class?',
            'correct_answer' => 'A new student',
            'answer1' => 'A teacher',
            'answer2' => 'His cousin',
            'answer3' => 'His old friend',
            'stories_id' => 10,
        ]);
        \App\Models\questions::create([
            'question' => 'How did the new student feel?',
            'correct_answer' => 'Shy and nervous',
            'answer1' => 'Excited',
            'answer2' => 'Angry',
            'answer3' => 'Bored',
            'stories_id' => 10,
        ]);
        \App\Models\questions::create([
            'question' => 'What did Rami do?',
            'correct_answer' => 'Became his first friend',
            'answer1' => 'Ignored him',
            'answer2' => 'Made fun of him',
            'answer3' => 'Moved seats',
            'stories_id' => 10,
        ]);
    }
}
