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
        $plans = [['Early Action', 'EA'],['Early Decision', 'ED'],['Regular Decision', 'RD']];

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
            DB::table('applicants')->insert([
                'surname' => $faker->name,
                'plan_id' => random_int(1, 30)
            ]);

            foreach (range(1, 5) as $j) {
                DB::table('admission_applications')->insert([
                    'applicant_id' => $i,
                    'university_id' => random_int(1, 100),
                    'plan_id' => random_int(1, 3),
                    'decision_id' => random_int(1, 4)
                ]);
            }

            if (random_int(0, 1)) {
                // TOEFL
                DB::table('applicant_exam_toefls')->insert([
                    'applicant_id' => $i,
                    'taken_on' => $faker->date(),
                    'reading' => random_int(10, 30),
                    'listening' => random_int(10, 30),
                    'speaking' => random_int(10, 30),
                    'writing' => random_int(10, 30),
                ]);
            }
            else {
                // IELTS
                DB::table('applicant_exam_ieltss')->insert([
                    'applicant_id' => $i,
                    'taken_on' => $faker->date(),
                    'reading' => random_int(0, 18),
                    'writing' => random_int(0, 18),
                    'listening' => random_int(0, 18),
                    'speaking' => random_int(0, 18)
                ]);
            }

            if (random_int(0, 1)) {
                // SAT
                DB::table('applicant_exam_sats')->insert([
                    'applicant_id' => $i,
                    'taken_on' => $faker->date(),
                    'reading' => random_int(10, 40) * 10,
                    'writing' => random_int(10, 40) * 10,
                    'math' => random_int(20, 80) * 10,
                    'essay' => "".random_int(1,8)."".random_int(1,8)."".random_int(1,8).""
                ]);
            }
            else {
                // ACT
                DB::table('applicant_exam_acts')->insert([
                    'applicant_id' => $i,
                    'taken_on' => $faker->date(),
                    'reading' => random_int(0, 36),
                    'english' => random_int(0, 36),
                    'math' => random_int(0, 36),
                    'science' => random_int(0, 36)
                ]);
            }

            foreach (range(1, 3) as $j) {
                // SAT Subject
                DB::table('applicant_exam_sat_subjects')->insert([
                    'applicant_id' => $i,
                    'taken_on' => $faker->date(),
                    'subject' => $faker->name,
                    'score' => random_int(20, 80) * 10
                ]);
            }

            foreach (range(1, 5) as $j) {
                // AP
                DB::table('applicant_exam_aps')->insert([
                    'applicant_id' => random_int(1, 100),
                    'taken_on' => $faker->date(),
                    'subject' => $faker->name,
                    'score' => random_int(1, 5)
                ]);
            }

        }
    }
}
