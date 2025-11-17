<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkGuide>
 */
class WorkGuideFactory extends Factory
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
            'caboclo' => fake()->optional()->name(),
            'cabocla' => fake()->optional()->name(),
            'ogum' => fake()->optional()->name(),
            'xango' => fake()->optional()->name(),
            'exu' => fake()->optional()->name(),
            'pombagira' => fake()->optional()->name(),
        ];
    }
}
