<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reviews;
use App\Models\User;
use App\Models\Books;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $books = Books::all();
        $users = User::all();

        $books->each(function ($book) use ($users, $faker) {
            $reviewCount = rand(1, 5);
            $reviews = [];

            for ($i = 0; $i < $reviewCount; $i++) {
                $user = $users->random();
                $reviews[] = [
                    'user_id' => $user->id,
                    'reviewable_id' => $book->id,
                    'reviewable_type' => Books::class,
                    'rating'=> rand(1, 5),
                    'comment' => $faker->text(100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Reviews::insert($reviews);

            // Update the average rating of the book
            $averageRating = Reviews::where('reviewable_id', $book->id)
            ->where('reviewable_type', Books::class)
            ->avg('rating');

            $book->average_rating = $averageRating;
            $book->save();
        });
    }
}
