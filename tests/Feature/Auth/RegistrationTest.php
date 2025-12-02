<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $admin = \App\Models\User::factory()->create();

        $invitation = \App\Models\Invitation::create([
            'email' => 'test@example.com',
            'token' => 'valid-token',
            'expires_at' => now()->addDays(1),
            'invited_by' => $admin->id,
        ]);

        $response = $this->get('/register?token=' . $invitation->token);

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        \Spatie\Permission\Models\Role::create(['name' => 'user']);
        $admin = \App\Models\User::factory()->create();

        $invitation = \App\Models\Invitation::create([
            'email' => 'test@example.com',
            'token' => 'valid-token',
            'expires_at' => now()->addDays(1),
            'invited_by' => $admin->id,
        ]);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $invitation->token,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
