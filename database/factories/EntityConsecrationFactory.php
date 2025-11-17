<?php

namespace Database\Factories;

use App\Models\EntityConsecration;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EntityConsecration>
 */
class EntityConsecrationFactory extends Factory
{
    protected $model = EntityConsecration::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $entities = [
            'Oxalá' => ['Oxalufã', 'Oxaguiã'],
            'Ogum' => ['Ogum Beira-Mar', 'Ogum Megê'],
            'Oxóssi' => ['Oxóssi Pã', 'Oxóssi Akuerô'],
            'Xangô' => ['Xangô Agodô', 'Xangô Airá'],
            'Iemanjá' => ['Iemanjá Ogunté', 'Iemanjá Assessu'],
        ];

        $entity = fake()->randomElement(array_keys($entities));

        return [
            'user_id' => User::factory(),
            'entity' => $entity,
            'name' => fake()->randomElement($entities[$entity]),
            'date' => fake()->dateTimeBetween('-10 years', 'now'),
        ];
    }
}
