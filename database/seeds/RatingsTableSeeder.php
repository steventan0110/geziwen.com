<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/14
 * Time: 14:14
 */
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder {

    public function run() {

        $faker = Faker\Factory::create();

        foreach (range(1, 100) as $i) {
            DB::table('ratings')->insert([
                //private change
                'rate' => random_int(1, 10),
                'rateable_id' => random_int(1, 50)
            ]);
            if ($i%2==0) {
                DB::table('ratings')->insert([
                    'rateable_type' => 'agencies'
                ]);
            }
            elseif ($i%2!=0) {
                DB::table('ratings')->insert([
                    'rateable_type' => 'teachers'
                ]);
            }
        }
    }
}