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
         $this->call(\ToeflTableSeeder::class);
         $this->call(\SatTableSeeder::class);
    }
}
