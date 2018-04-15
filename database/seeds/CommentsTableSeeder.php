<?php
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder {

    public function run() {

        $faker = Faker\Factory::create();

        foreach (range(1, 2000) as $i) {
            if ($i % 2 == 0) {
                DB::table('comments')->insert([
                    'user_id' => random_int(1, 100),
                    'body' => $faker->sentence,
                    'commentable_id' => random_int(1, 10),
                    'commentable_type' => 'agencies',
                    'rate' => random_int(1, 5)
                ]);
            }
            else {
                DB::table('comments')->insert([
                    'user_id' => random_int(1, 100),
                    'body' => $faker->sentence,
                    'commentable_id' => random_int(1, 100),
                    'commentable_type' => 'teachers',
                    'rate' => random_int(1, 5)
                ]);
            }
        }
    }
}