<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'test' . $this->faker->randomDigit(),
            'photo' => $this->faker->imageUrl(640, 480),
            'description' => $this->faker->paragraph(3, true),
            'preparation_time' => $this->faker->numberBetween(1000,9000),
            'is_active' => $this->faker->boolean(90),
            'restaurant_id' => 1
        ];
    }
}
