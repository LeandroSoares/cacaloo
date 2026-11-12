<?php

namespace Database\Factories;

use App\Models\LastTemple;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LastTemple>
 */
class LastTempleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->company(),
            'address' => fake()->optional()->address(),
            'leader_name' => fake()->optional()->name(),
            'function' => fake()->optional()->jobTitle(),
            'exit_reason' => fake()->optional()->sentence(),
        ];
    }
}
