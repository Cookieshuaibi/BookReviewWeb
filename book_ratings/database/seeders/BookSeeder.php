<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Books;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            $user = $users->random();
            Books::create([
                'title' => $faker->sentence(3),
                'summary'=> $faker->text(200),
                'user_id'=>$user->id,
                'author'=> $faker->name,
                'average_rating' => $faker->randomFloat(2, 1, 5),
                'image_url' => $faker->imageUrl(),
                'genre' => $faker->word,
                'year' => $faker->year,
                'publisher' => $faker->company,
                'language' => $faker->languageCode,
                'isbn' => $faker->isbn13,
                'author' => $faker->name,
                'description' => $faker->paragraph,

            ]);
        }
    }
}
