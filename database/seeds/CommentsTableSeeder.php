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
            DB::table('comments')->insert([
                //private change
                'body' => $faker->sentence,
                'commentable_id' => random_int(1, 50),
            ]);
            if ($i%2==0) {
                DB::table('comments')->insert([
                    'commentable_type' => 'agencies'
                ]);
            }
            elseif ($i%2!=0) {
                DB::table('comments')->insert([
                    'commentable_type' => 'teachers'
                ]);
            }
        }
    }
}