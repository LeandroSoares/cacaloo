<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crowning>
 */
class CrowningFactory extends Factory
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
            'start_date' => fake()->optional()->date(),
            'end_date' => fake()->optional()->date(),
            'guide_name' => fake()->optional()->name(),
            'priest_name' => fake()->name(),
            'temple_name' => fake()->company(),
        ];
    }
}
