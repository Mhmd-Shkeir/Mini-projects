<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(5),
            'genre' => $this->faker->randomElement(['Action', 'Drama', 'Comedy', 'Horror', 'Romance', 'Sci-Fi', 'Thriller']),
            'year' => $this->faker->year(),
            'duration' => $this->faker->numberBetween(90, 180),
            'poster_url' => null,
        ];
    }
}
