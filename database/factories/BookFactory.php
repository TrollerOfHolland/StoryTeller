<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'author' => $this->faker->name,
            'ageLimit' => $this->faker->boolean(),
            'rating' => $this->faker->randomFloat(0,1,5),
            'numOfRates' => $this->faker->random_int(1,10),
            'content' => $this->faker->text(200),
        ];
    }
}
