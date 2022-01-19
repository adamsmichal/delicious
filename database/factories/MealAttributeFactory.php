<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MealAttributeFactory extends Factory
{
    private static $mealId = 1;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sizes = ['Small', 'Medium', 'Large'];
        return [
            'price' => $this->faker->numberBetween(1000, 7000),
            'size' => $sizes[$this->faker->numberBetween(0, 2)],
            'meal_id' => self::$mealId++
        ];
    }
}
