<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/4/15
 * Time: 17:04
 */
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder{

    public function run() {

        $faker = Faker\Factory::create();

        foreach (range(1, 100) as $i) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->password,
                'role' => 'user',
                'link' => 0
            ]);
        }
    }

}