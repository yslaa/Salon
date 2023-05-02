<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index){
            DB::table('services')->insert([
                'service'=> $faker->word,
                'cost'=> $faker->randomDigit,
                'product_id'=> $faker->randomElement(array(3,5)),
                'employee_id'=> $faker->randomElement(array(1,2)),
                'created_at'=> $faker->dateTimeThisYear()->format('Y-m-d'),
                'updated_at'=> $faker->dateTimeThisYear()->format('Y-m-d')
            ]);
        }
    }
}
