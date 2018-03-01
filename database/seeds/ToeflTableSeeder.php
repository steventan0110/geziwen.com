<?php

use Illuminate\Database\Seeder;

class ToeflTableSeeder extends Seeder
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
            DB::table('toefls')->insert([
                'student' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'reading' => random_int(10, 30),
                'listening' => random_int(10, 30),
                'speaking' => random_int(10, 30),
                'writing' => random_int(10, 30),
            ]);
        }
    }
}
