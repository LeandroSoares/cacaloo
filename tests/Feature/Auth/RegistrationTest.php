<?php

namespace Tests\Feature\Auth;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $admin = User::factory()->create();

        $invitation = Invitation::create([
            'email' => 'test@example.com',
            'token' => 'valid-token',
            'expires_at' => now()->addDays(1),
            'invited_by' => $admin->id,
        ]);

        $response = $this->get('/register?token='.$invitation->token);

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        Role::create(['name' => 'user']);
        $admin = User::factory()->create();

        $invitation = Invitation::create([
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
