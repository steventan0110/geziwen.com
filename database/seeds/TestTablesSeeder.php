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
        foreach (range(1, 1000) as $i) {
            DB::table('toefls')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'reading' => random_int(10, 30),
                'listening' => random_int(10, 30),
                'speaking' => random_int(10, 30),
                'writing' => random_int(10, 30),
            ]);
        }
        // IELTS
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
        // SAT
        foreach (range(1, 1000) as $i) {
            DB::table('sats')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'reading' => random_int(10, 40) * 10,
                'writing' => random_int(10, 40) * 10,
                'math' => random_int(20, 80) * 10,
                'essay' => "".random_int(1,8)."".random_int(1,8)."".random_int(1,8).""
            ]);
        }
        // SAT Subject
        foreach (range(1, 1000) as $i) {
            DB::table('sat_subjects')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'subject' => $faker->name,
                'score' => random_int(20, 80) * 10
            ]);
        }
        // AP
        foreach (range(1, 1000) as $i) {
            DB::table('aps')->insert([
                'applicant_id' => random_int(1, 100),
                'taken_on' => $faker->date(),
                'subject' => $faker->name,
                'score' => random_int(1, 5)
            ]);
        }
    }
}
