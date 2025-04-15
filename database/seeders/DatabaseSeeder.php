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

        $admin = \App\Models\User::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => bcrypt('admin'),
            'role' => 0,
        ]);

        // Story data
        $stories = [
            [
                'title' => 'The Lost Puppy',
                'body' => 'Lina was walking in the park...',
                'description' => 'Lina finds a lost puppy and helps it return home.',
            ],
            [
                'title' => 'The Broken Vase',
                'body' => 'Ali was playing football inside...',
                'description' => 'Ali breaks a vase and chooses honesty.',
            ],
            [
                'title' => 'A Day Without Electricity',
                'body' => 'One evening, the power went out...',
                'description' => 'Family bonds grow stronger during a blackout.',
            ],
            [
                'title' => 'The School Trip',
                'body' => 'The students visited the zoo...',
                'description' => 'Students enjoy learning during a zoo trip.',
            ],
            [
                'title' => 'The Magic Pen',
                'body' => 'Ravi found an old pen...',
                'description' => 'A magical pen that brings words to life.',
            ],
            [
                'title' => 'The Rainy Day',
                'body' => 'It started raining heavily...',
                'description' => 'A story of friendship in the rain.',
            ],
            [
                'title' => 'The Missing Homework',
                'body' => 'Jake forgot his homework...',
                'description' => 'Jake learns that honesty matters.',
            ],
            [
                'title' => 'The Brave Little Girl',
                'body' => 'A little girl saw a kitten...',
                'description' => 'A girl rescues a kitten in need.',
            ],
            [
                'title' => 'The Surprise Gift',
                'body' => 'Sara baked cookies for her brother...',
                'description' => 'Sara surprises her brother with cookies.',
            ],
            [
                'title' => 'The New Student',
                'body' => 'A new student joined Rami’s class...',
                'description' => 'Rami welcomes a nervous new student.',
            ],
        ];

        foreach ($stories as $index => $storyData) {
            $story = \App\Models\stories::create([
                'id' => $index + 1,
                'title' => $storyData['title'],
                'body' => $storyData['body'],
                'description' => $storyData['description'],
                'Author' => 'Admin',
                'Difficulty' => rand(1, 3),
                'is_active' => true,
                'views' => rand(0, 100),
                'user_id' => $admin->id,
            ]);
        }

        // You can leave your questions logic as-is or refactor similarly.

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
