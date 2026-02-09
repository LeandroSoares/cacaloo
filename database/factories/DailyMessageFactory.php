<?php

namespace Database\Factories;

use App\Models\DailyMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class DailyMessageFactory extends Factory
{
    protected $model = DailyMessage::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
            'author' => $this->faker->name,
            'active' => true,
            'valid_from' => now(),
            'valid_until' => now()->addDays(7),
        ];
    }
}
