<?php

use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $ACTIVITY_TYPES = ["Academic",
            "Art",
            "Athletics: Club",
            "Athletics: JV/Varsity",
            "Career Oriented",
            "Community Service (Volunteer)",
            "Computer/Technology",
            "Cultural",
            "Dance",
            "Debate/Speech",
            "Environmental",
            "Family Responsibilities",
            "Foreign Exchange",
            "Foreign Language",
            "Internship",
            "Journalism/Publication",
            "Junior R.O.T.C.",
            "LGBT",
            "Music: Instrumental",
            "Music: Vocal",
            "Religious",
            "Research",
            "Robotics",
            "School Spirit",
            "Science/Math",
            "Social Justice",
            "Student Govt./Politics",
            "Theater/Drama",
            "Work (Paid)",
            "Other Club/Activity"];
        // Activity Types
        foreach ($ACTIVITY_TYPES as $type) {
            DB::table('activity_types')->insert([
                'name' => $type
            ]);
        }
        // Activities
        foreach (range(1, 1000) as $i) {
            DB::table('activities')->insert([
                'applicant_id' => random_int(1, 100),
                'type_id' => random_int(1, count($ACTIVITY_TYPES)),
                'name' => $faker->name,
                'description' => $faker->text,
                'start' => $faker->date(),
                'end' => $faker->date(),
                'hours_per_week' => random_int(1, 7 * 24)
            ]);
        }
    }
}
