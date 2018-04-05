<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/14
 * Time: 14:14
 */
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder {

    public function run() {

        $faker = Faker\Factory::create();

        foreach (range(1, 100) as $i) {
            if ($i % 2 == 0) {
                DB::table('comments')->insert([
                    'username' => $faker->name,
                    'body' => $faker->sentence,
                    'commentable_id' => random_int(1, 50),
                    'commentable_type' => 'agencies',
                    'rate' => random_int(1, 5)
                ]);
            }
            else {
                DB::table('comments')->insert([
                    'username' => $faker->name,
                    'body' => $faker->sentence,
                    'commentable_id' => random_int(1, 50),
                    'commentable_type' => 'teachers',
                    'rate' => random_int(1, 5)
                ]);
            }
        }
    }
}