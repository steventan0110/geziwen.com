<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/14
 * Time: 14:14
 */
use Illuminate\Database\Seeder;

class TeacherCommentsTableSeeder extends Seeder {

    public function run() {

        $faker = Faker\Factory::create();

        foreach (range(1, 100) as $i) {
            DB::table('teacher_comments')->insert([
                //private change
                'body' => $faker->sentence,
                'teacher_id' => random_int(1, 50)
            ]);
        }
    }
}