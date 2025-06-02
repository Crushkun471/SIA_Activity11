<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'water_requirement' => $this->faker->randomElement(['Low', 'Medium', 'High']),
            'temperature' => $this->faker->numberBetween(15, 35), // degrees Celsius
            'planted_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'price' => $this->faker->randomFloat(2, 10, 200), // $10.00 to $200.00
        ];
    }
}
