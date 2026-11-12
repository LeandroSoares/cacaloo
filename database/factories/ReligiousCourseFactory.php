<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\ReligiousCourse;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ReligiousCourse>
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
            'user_id' => User::factory(),
            'course_id' => Course::factory(),
            'date' => $this->faker->date(),
            'finished' => $this->faker->boolean,
            'has_initiation' => $this->faker->boolean,
            'initiation_date' => $this->faker->date(),
            'observations' => $this->faker->sentence,
        ];
    }
}
