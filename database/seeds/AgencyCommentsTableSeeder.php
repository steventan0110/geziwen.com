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

        foreach (range(1, 10) as $i) {
            DB::table('agency_comments')->insert([
                //private change
                'body' => $faker->sentence,
                'agency_id' => random_int(1, 10)
            ]);
        }
    }
}