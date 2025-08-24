<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a criação de um usuário.
     */
    public function test_can_create_user()
    {
        $userData = [
            'name' => 'Teste User',
            'email' => 'teste@example.com',
            'password' => bcrypt('password'),
        ];

        $user = User::create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Teste User', $user->name);
        $this->assertEquals('teste@example.com', $user->email);
        $this->assertDatabaseHas('users', ['email' => 'teste@example.com']);
    }
}
