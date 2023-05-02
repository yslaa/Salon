<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Faker\Factory;
// use Hash;
// use DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Factory::create();

        // $role = ['customer', 'employee', 'admin', 'supplier'];

        // $image = ['rango.jpg', 'reveDay1.jpg', 'joy.jpg', 'humpty dumpty.jpg'];

        // foreach (range(1,10) as $index){
        //     DB::table('users')->insert([
        //         'name' => $faker->name,
        //         'email' => $faker->unique()->safeEmail,
        //         'password' => Hash::make('password'),
        //         'role' => $faker->randomElement($role),
        //         'images' => $faker->randomElement($image),
        //         'created_at' => $faker->dateTimeThisYear()->format('Y-m-d'),
        //         'updated_at' => $faker->dateTimeThisYear()->format('Y-m-d')
        //     ]);
        // }
    }
}
