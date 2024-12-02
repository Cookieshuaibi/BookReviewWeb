<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Books;
use App\Models\Reviews;
use App\Models\User;
use Faker\Factory as Faker;
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

        // Create 10 users
        $users =  User::factory(10)->create();

        // Create 20 books
        $books = Books::factory(20)->create();

        // Create reviews for each book
        foreach ($books as $book) {
            $user = $users->random();
            Reviews::factory()->create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'rating' => $faker->numberBetween(1, 10),
                'comment' => $faker->sentence,
            ]);

            // Add additional reviews for the book
            for ($i = 0; $i < $faker->numberBetween(0, 5); $i++) {
                $user = $users->random();
                Reviews::factory()->create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'rating' => $faker->numberBetween(1, 5),
                    'comment' => $faker->sentence,
                ]);
            }
        }
    }
}
