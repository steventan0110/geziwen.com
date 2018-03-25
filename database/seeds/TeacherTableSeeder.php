<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/13
 * Time: 11:22
 */
use Illuminate\Database\Seeder;

class TeacherTableSeeder extends Seeder {

    public function run() {

        $faker = Faker\Factory::create();

        foreach (range(1,100) as $i) {
            DB::table('teachers')->insert([
                'name' => $faker->name,
                'agency_id' => random_int(1, 10),
                'subject' => $faker->text,
                'introduction' => $faker->text,
                'years_of_teaching' => $faker->year,
                'picture' => $faker->url,
                'type' => 'teacher',
                'type_id' => 1
            ]);
        }

    }
}