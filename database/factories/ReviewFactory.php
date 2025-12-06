<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? 1,
            'movie_id' => Movie::inRandomOrder()->first()?->id ?? 1,
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(3),
            'rating' => $this->faker->numberBetween(1,5),
        ];
    }
}
