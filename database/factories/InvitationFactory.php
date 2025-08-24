<?php

namespace Database\Factories;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InvitationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invitation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'token' => Invitation::generateToken(),
            'status' => Invitation::STATUS_PENDING,
            'invited_by' => User::factory(),
            'expires_at' => Carbon::now()->addDays(7),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    /**
     * Indica que o convite está expirado.
     */
    public function expired(): self
    {
        return $this->state(fn (array $attributes) => [
            'expires_at' => Carbon::now()->subDays(1),
        ]);
    }

    /**
     * Indica que o convite foi aceito.
     */
    public function accepted(): self
    {
        return $this->state(fn (array $attributes) => [
            'status' => Invitation::STATUS_ACCEPTED,
            'accepted_at' => Carbon::now(),
            'accepted_by' => User::factory(),
        ]);
    }

    /**
     * Indica que o convite foi cancelado.
     */
    public function cancelled(): self
    {
        return $this->state(fn (array $attributes) => [
            'status' => Invitation::STATUS_CANCELLED,
        ]);
    }
}
