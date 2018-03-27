<?php

use Illuminate\Database\Seeder;

class AgencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1, 10) as $i) {
            DB::table('agencies')->insert([
                'name' => $faker->name,

                //private change
                'introduction' => $faker->sentence,
                'address' => $faker->address,
                'telephone' => $faker->phoneNumber,
                'website' => $faker->url,
                'email' => $faker->email,
                'started_on' => $faker->date()
            ]);

            foreach (range(1, 3) as $j) {
                DB::table('agency_service_plans')->insert([
                    'agency_id' => $i,
                    'name' => $faker->word,
                    'price' => random_int(30, 100) * 1000,
                    //private change
                    'introduction' => $faker->paragraph
                ]);

                foreach (range(1, 5) as $k) {
                    DB::table('agency_service_steps')->insert([
                        'plan_id' => ($i - 1) * 3 + $j,
                        'name' => $faker->word,
                        //private change
                        'introduction' => $faker->paragraph,
                        'period' => $faker->sentence
                    ]);
                }

                foreach (range(1, 3) as $k) {
                    DB::table('agency_service_features')->insert([
                        'plan_id' => ($i - 1) * 3 + $j,
                        'name' => $faker->word,
                        'introduction' => $faker->paragraph
                    ]);
                }
            }
        }
    }
}
