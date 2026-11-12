<?php

namespace Database\Factories;

use App\Models\Crowning;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Crowning>
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
            'user_id' => User::factory(),
            'start_date' => fake()->optional()->date(),
            'end_date' => fake()->optional()->date(),
            'guide_name' => fake()->optional()->name(),
            'priest_name' => fake()->name(),
            'temple_name' => fake()->company(),
        ];
    }
}
