<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name(),
            'isbn' => Str::random(10),
            'authors' => [$this->faker->name(), $this->faker->name()],
            'country' => 'Nigeria',
            'number_of_pages' => 75,
            'publisher' => 'Latest Publisher',
            'release_date' => '2022-02-05'
        ];
    }
}
