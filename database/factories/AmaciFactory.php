<?php

namespace Database\Factories;

use App\Models\Amaci;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Amaci>
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
            'user_id' => User::factory(),
            'type' => fake()->randomElement($types),
            'observations' => fake()->optional()->sentence(),
            'date' => fake()->date(),
        ];
    }
}
