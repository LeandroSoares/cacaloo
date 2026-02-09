<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReligiousCourse>
 */
class ReligiousCourseFactory extends Factory
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
            'course_id' => \App\Models\Course::factory(),
            'date' => $this->faker->date(),
            'finished' => $this->faker->boolean,
            'has_initiation' => $this->faker->boolean,
            'initiation_date' => $this->faker->date(),
            'observations' => $this->faker->sentence,
        ];
    }
}
