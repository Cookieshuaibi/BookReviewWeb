<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\books>
 */
class booksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //'title', 'author', 'year', 'genre', 'description','average_rating','image_url',summary
        return [
            
            'title' => ucfirst(fake()->word()) . ' ' . ucfirst(fake()->word()),
            'author' => fake()->name(),
            'year' => fake()->year(),
            'genre' => fake()->word(),
            'summary' => fake()->sentence(),
            //'description' => fake()->randomHtml(),
            'description' => fake()->text(),
            'average_rating' => random_int(1,5),
            'image_url' =>fake()->imageUrl(),
            'isbn' => fake()->isbn13(),
            'publisher' => fake()->company(),
            'language' => fake()->languageCode(),

        ];
    }
}
