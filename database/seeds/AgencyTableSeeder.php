<?php

use Illuminate\Database\Seeder;

class AgencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1, 10) as $i) {
            DB::table('agencies')->insert([
                'name' => $faker->name,
                'introduction' => $faker->text,
                'address' => $faker->address,
                'telephone' => $faker->phoneNumber,
                'website' => $faker->url,
                'email' => $faker->email,
                'started_on' => $faker->date()
            ]);
        }
    }
}
