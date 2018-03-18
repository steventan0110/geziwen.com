<?php

use Illuminate\Database\Seeder;

class TestTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        // TOEFL
        foreach (range(1, 500) as $i) {
            DB::table('applicant_exam_toefls')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'reading' => random_int(10, 30),
                'listening' => random_int(10, 30),
                'speaking' => random_int(10, 30),
                'writing' => random_int(10, 30),
            ]);
        }
        // IELTS
        foreach (range(1, 500) as $i) {
            DB::table('applicant_exam_ieltss')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'reading' => random_int(0, 18),
                'writing' => random_int(0, 18),
                'listening' => random_int(0, 18),
                'speaking' => random_int(0, 18)
            ]);
        }
        // SAT
        foreach (range(1, 500) as $i) {
            DB::table('applicant_exam_sats')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'reading' => random_int(10, 40) * 10,
                'writing' => random_int(10, 40) * 10,
                'math' => random_int(20, 80) * 10,
                'essay' => "".random_int(1,8)."".random_int(1,8)."".random_int(1,8).""
            ]);
        }
        // SAT Subject
        foreach (range(1, 500) as $i) {
            DB::table('applicant_exam_sat_subjects')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'subject' => $faker->name,
                'score' => random_int(20, 80) * 10
            ]);
        }
        // AP
        foreach (range(1, 500) as $i) {
            DB::table('applicant_exam_aps')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'subject' => $faker->name,
                'score' => random_int(1, 5)
            ]);
        }
        // ACT
        foreach (range(1, 500) as $i) {
            DB::table('applicant_exam_acts')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'reading' => random_int(0, 36),
                'english' => random_int(0, 36),
                'math' => random_int(0, 36),
                'science' => random_int(0, 36)
            ]);
        }
    }
}
