<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city' => $this->faker->city(),
            'street' => $this->faker->streetName(),
            'house_number' => $this->faker->buildingNumber(),
            'flat_number' => $this->faker->randomDigit(),
            'post_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'country_iso' => $this->faker->countryISOAlpha3()
        ];
    }
}
