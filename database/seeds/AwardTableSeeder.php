<?php

use Illuminate\Database\Seeder;

class AwardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach (range(1, 1000) as $i) {
            DB::table('awards')->insert([
                'applicant_id' => random_int(1, 100),
                'name' => $faker->name,
                'description' => $faker->text,
                'received_on' => $faker->date()
            ]);
        }
    }
}
