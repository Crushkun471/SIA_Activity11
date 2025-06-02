<?php

namespace Database\Factories;

use App\Models\AccessUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccessUser>
 */
class AccessUserFactory extends Factory
{
    protected $model = AccessUser::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'fingerprint_id' => $this->faker->unique()->numberBetween(1000, 9999),
            'access_level' => $this->faker->randomElement(['owner', 'family', 'guest']),
            'last_accessed_at' => now(),
        ];
    }
}
