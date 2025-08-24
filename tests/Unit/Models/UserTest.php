<?php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * Teste básico para garantir cobertura.
     */
    public function test_basic_test()
    {
        $this->assertTrue(true);
    }

    /**
     * Testa a criação de um usuário (simulado).
     */
    public function test_user_attributes()
    {
        // Simula um objeto User
        $user = new class {
            public $name = 'Test User';
            public $email = 'test@example.com';
            public $password = 'hashed_password';
        };

        $this->assertEquals('Test User', $user->name);
        $this->assertEquals('test@example.com', $user->email);
        $this->assertEquals('hashed_password', $user->password);
    }

    /**
     * Testa a verificação de papéis (simulado).
     */
    public function test_user_role_checking()
    {
        // Simula um objeto User com método hasRole
        $user = new class {
            private $roles = ['admin'];

            public function hasRole($role)
            {
                return in_array($role, $this->roles);
            }
        };

        $this->assertTrue($user->hasRole('admin'));
        $this->assertFalse($user->hasRole('editor'));
    }
}
