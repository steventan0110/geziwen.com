<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class ApplicantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1, 100) as $i) {
            DB::table('applicants')->insert([
                'name' => $faker->name,
                'introduction' => $faker->text,
                'graduation_year' => $faker->year,
                'picture' => $faker->url,
                'plan_id' => random_int(1, 30)
            ]);
        }
    }
}
