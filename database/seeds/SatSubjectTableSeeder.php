<?php

use Illuminate\Database\Seeder;

class SatSubjectTableSeeder extends Seeder
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
            DB::table('sat_subjects')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'subject' => $faker->name,
                'score' => random_int(20, 80) * 10
            ]);
        }
    }
}
