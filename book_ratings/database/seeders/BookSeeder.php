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
        $faker = Faker::create();
        $users = User::all();
        foreach (range(1, 10) as $index) { // 创建 10 本书
            Books::create([
                'title' => $faker->sentence(3),
                'user_id'=>$users->random()->id,
                'summary'=> $faker->text(200),
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
