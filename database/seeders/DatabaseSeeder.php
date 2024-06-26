<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Student;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $gender = $faker->randomElement(['male', 'female']);
        foreach (range(1,200) as $index) {
            Student::insert([
                'name'  => $faker->name($gender),
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
            ]);
        }
    }
}
