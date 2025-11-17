<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Amaci>
 */
class AmaciFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'Amaci de Oxalá',
            'Amaci de Ogum',
            'Amaci de Oxóssi',
            'Amaci de Iemanjá',
            'Amaci de Xangô',
        ];

        return [
            'user_id' => \App\Models\User::factory(),
            'type' => fake()->randomElement($types),
            'observations' => fake()->optional()->sentence(),
            'date' => fake()->date(),
        ];
    }
}
