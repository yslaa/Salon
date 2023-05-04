<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\AdminModel;
use App\Models\CustomerModel;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create users
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'role' => 'user',
            ];
        }
        User::insert($users);

        $this->call([
            // UserSeeder::class,
            ProductSeeder::class,
            ServiceSeeder::class
        ]);
    }
}