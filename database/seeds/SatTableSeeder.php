<?php

use Illuminate\Database\Seeder;

class SatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1, 1000) as $i) {
            DB::table('sats')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'reading' => random_int(10, 40) * 10,
                'writing' => random_int(10, 40) * 10,
                'math' => random_int(20, 80) * 10,
                'essay' => "".random_int(1,8)."".random_int(1,8)."".random_int(1,8).""
            ]);
        }
    }
}
