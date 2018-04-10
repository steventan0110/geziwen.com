<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/14
 * Time: 16:12
 */
use Illuminate\Database\Seeder;

class AgencyRatingsTableSeeder extends Seeder {

    public function run() {

        $faker = Faker\Factory::create();

        foreach (range(1, 10) as $i) {
            DB::table('agency_ratings')->insert([
                'rating' => random_int(1, 10),
                'agency_id' => random_int(1, 10)
            ]);
        }
    }
}