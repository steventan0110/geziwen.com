<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/14
 * Time: 16:01
 */

use Illuminate\Database\Seeder;

class TeacherRatingsTableSeeder extends Seeder {

    public function run() {

        $faker = Faker\Factory::create();

        foreach (range(1, 100) as $i) {
            DB::table('teacher_ratings')->insert([
                'rating' => random_int(1, 10),
                'teacher_id' => random_int(1, 50)
            ]);
        }
    }
}


