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
         $this->call(\CommentsTableSeeder::class);
         $this->call(\AgencyTableSeeder::class);
         $this->call(\ApplicantsTableSeeder::class);
         $this->call(\TeachersApplicantsTableSeeder::class);
         $this->call(\TeacherTableSeeder::class);
         $this->call(\UserTableSeeder::class);
    }
}
