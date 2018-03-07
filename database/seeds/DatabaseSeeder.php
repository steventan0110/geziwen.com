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
         $this->call(\ApplicantsTableSeeder::class);
         $this->call(\AgencyTableSeeder::class);
         $this->call(\TestTablesSeeder::class);
         $this->call(\ActivitiesTableSeeder::class);
         $this->call(\AwardTableSeeder::class);
         $this->call(\AdmissionTablesSeeder::class);
    }
}
