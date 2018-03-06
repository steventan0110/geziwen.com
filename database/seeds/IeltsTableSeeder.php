<?php

use Illuminate\Database\Seeder;

class IeltsTableSeeder extends Seeder
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
            DB::table('ieltss')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'reading' => random_int(0, 18),
                'writing' => random_int(0, 18),
                'listening' => random_int(0, 18),
                'speaking' => random_int(0, 18)
            ]);
        }
    }
}
