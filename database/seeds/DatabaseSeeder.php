<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(\ActivitiesTableSeeder::class);
         $this->call(\AgencyCommentsTableSeeder::class);
         $this->call(\AgencyRatingsTableSeeder::class);
         $this->call(\AgencyTableSeeder::class);
         $this->call(\ApplicantsTableSeeder::class);
         $this->call(\AwardTableSeeder::class);
         $this->call(\TeacherCommentsTableSeeder::class);
         $this->call(\TeacherRatingsTableSeeder::class);
         $this->call(\TeachersApplicantsTableSeeder::class);
         $this->call(\TeacherTableSeeder::class);
    }
}
