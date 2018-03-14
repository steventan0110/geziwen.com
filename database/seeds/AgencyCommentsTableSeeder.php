<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/14
 * Time: 14:14
 */
use Illuminate\Database\Seeder;

class AgencyCommentsTableSeeder extends Seeder {

    public function run() {

        $faker = Faker\Factory::create();

        foreach (range(1, 100) as $i) {
            DB::table('agency_comments')->insert([
                'agency_name' => $faker->name,
                'comments' => $faker->text,
                'agency_id' => random_int(1, 50)
            ]);
        }
    }
}