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
        $decisions = [['Accepted', 'AC'], ['Deferred', 'DE'], ['Waitlist', 'WL'], ['Rejected', 'REJ']];

        $faker = Faker\Factory::create();

        foreach (range(1, 100) as $i) {
            DB::table('universities')->insert([
                'name' => $faker->name,
                'country' => $faker->countryCode,
                'website' => $faker->url
            ]);
        }

        foreach ($plans as $plan) {
            DB::table('plans')->insert([
                'name' => $plan[0],
                'shorthand' => $plan[1]
            ]);
        }

        foreach ($decisions as $decision) {
            DB::table('decisions')->insert([
                'name' => $decision[0],
                'shorthand' => $decision[1]
            ]);
        }

        foreach (range(1, 1000) as $i) {
            DB::table('applications')->insert([
                'applicant_id' => random_int(1, 100),
                'university_id' => random_int(1, 100),
                'plan_id' => random_int(1, 3),
                'decision_id' => random_int(1, 4)
            ]);
        }
    }
}
