<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) { 
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password'=>password_hash($faker->password(8), PASSWORD_DEFAULT),
                'email_verified_at' => $faker->dateTimeBetween('-10 days', 'now'),
                'remember_token' => $faker->uuid,
            ]);
        }
    }
}