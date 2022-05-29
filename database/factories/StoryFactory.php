<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Story>
 */
class StoryFactory extends Factory
{
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
            'numOfRates' => $this->faker->randomDigitNotNull(),
        ];
    }
}
