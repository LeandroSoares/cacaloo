<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LastTemple>
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
            'user_id' => \App\Models\User::factory(),
            'name' => fake()->company(),
            'address' => fake()->optional()->address(),
            'leader_name' => fake()->optional()->name(),
            'function' => fake()->optional()->jobTitle(),
            'exit_reason' => fake()->optional()->sentence(),
        ];
    }
}
