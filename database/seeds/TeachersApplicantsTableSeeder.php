<?php

use Illuminate\Database\Seeder;

class TeachersApplicantsTableSeeder extends Seeder
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
            DB::table('teachers_applicants')->insert([
                'applicant_id' => random_int(1, 100),
                'teacher_id' => random_int(1, 50)
            ]);
        }
    }
}
