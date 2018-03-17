<?php

use Illuminate\Database\Seeder;

class AdmissionTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [['Early Action', 'EA'],['Early Decision', 'ED'],['Regular Decision', 'RD']];

        $faker = Faker\Factory::create();

        foreach (range(1, 100) as $i) {
            DB::table('admission_universities')->insert([
                'name' => $faker->name,
                'country' => $faker->countryCode,
                'website' => $faker->url
            ]);
        }

        foreach ($plans as $plan) {
            DB::table('admission_plans')->insert([
                'name' => $plan[0],
                'shorthand' => $plan[1]
            ]);
        }

        foreach (range(1, 1000) as $i) {
            DB::table('admission_applications')->insert([
                'applicant_id' => random_int(1, 100),
                'university_id' => random_int(1, 100),
                'plan_id' => random_int(1, 3),
                'decision_id' => random_int(1, 4)
            ]);
        }
    }
}
