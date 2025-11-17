<?php

namespace Database\Factories;

use App\Models\Crossing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crossing>
 */
class CrossingFactory extends Factory
{
    protected $model = Crossing::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'entity' => fake()->randomElement(['Exu', 'Pomba Gira', 'Preto Velho', 'Caboclo', 'Marinheiro']),
            'date' => fake()->dateTimeBetween('-5 years', 'now'),
            'purpose' => fake()->randomElement(['Proteção', 'Abertura de caminhos', 'Limpeza espiritual', 'Fortalecimento']),
        ];
    }
}
