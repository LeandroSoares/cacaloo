<?php

namespace Tests\Unit\Utils;

use App\Utils\PasswordHelper;
use PHPUnit\Framework\TestCase;

class PasswordHelperTest extends TestCase
{
    /**
     * Testa a geração de hash de senha.
     */
    public function test_hash()
    {
        $password = 'password123';
        $hash = PasswordHelper::hash($password);

        // Verifica se o hash foi gerado
        $this->assertNotEmpty($hash);

        // Verifica se o hash tem o formato correto (BCRYPT)
        $this->assertStringStartsWith('$2y$', $hash);

        // Verifica se o hash tem 60 caracteres (padrão BCRYPT)
        $this->assertEquals(60, strlen($hash));
    }

    /**
     * Testa a verificação de senha.
     */
    public function test_verify()
    {
        $password = 'password123';
        $hash = PasswordHelper::hash($password);

        // Senha correta
        $this->assertTrue(PasswordHelper::verify($password, $hash));

        // Senha incorreta
        $this->assertFalse(PasswordHelper::verify('wrong_password', $hash));
    }

    /**
     * Testa a verificação de necessidade de rehash.
     */
    public function test_needs_rehash()
    {
        $password = 'password123';

        // Hash BCRYPT com custo 12
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $this->assertFalse(PasswordHelper::needsRehash($hash));

        // Hash BCRYPT com custo 10 (menor que o padrão)
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        $this->assertTrue(PasswordHelper::needsRehash($hash));

        // Hash MD5 (não BCRYPT)
        $hash = md5($password);
        $this->assertTrue(PasswordHelper::needsRehash($hash));
    }

    /**
     * Testa a geração de senha aleatória.
     */
    public function test_generate()
    {
        // Geração padrão (12 caracteres com caracteres especiais)
        $password = PasswordHelper::generate();
        $this->assertEquals(12, strlen($password));

        // Geração com comprimento personalizado
        $password = PasswordHelper::generate(16);
        $this->assertEquals(16, strlen($password));

        // Geração sem caracteres especiais
        $password = PasswordHelper::generate(12, false);
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $password);

        // Geração com caracteres especiais
        $password = PasswordHelper::generate(12, true);
        // Verifica se 100 senhas geradas contêm pelo menos um caractere especial
        $foundSpecialChar = false;
        for ($i = 0; $i < 100; $i++) {
            $password = PasswordHelper::generate(12, true);
            if (preg_match('/[^a-zA-Z0-9]/', $password)) {
                $foundSpecialChar = true;
                break;
            }
        }
        $this->assertTrue($foundSpecialChar);
    }

    /**
     * Testa a avaliação da força da senha.
     */
    public function test_strength()
    {
        // Senha fraca (muito curta)
        $this->assertEquals(1, PasswordHelper::strength('abc'));

        // Senha com comprimento mínimo
        $this->assertEquals(2, PasswordHelper::strength('abcdefgh'));

        // Senha com letras minúsculas e maiúsculas
        $this->assertEquals(3, PasswordHelper::strength('abcdefGH'));

        // Senha com letras e números
        $this->assertEquals(4, PasswordHelper::strength('abcdefGH123'));

        // Senha com letras, números e caracteres especiais
        $this->assertEquals(6, PasswordHelper::strength('abcdefGH123!'));

        // Senha forte (todos os critérios)
        $this->assertEquals(6, PasswordHelper::strength('abcdefGHIJK123!@#'));
    }

    /**
     * Testa a verificação de segurança da senha.
     */
    public function test_is_secure()
    {
        // Senhas inseguras
        $this->assertFalse(PasswordHelper::isSecure('abc'));
        $this->assertFalse(PasswordHelper::isSecure('password'));
        $this->assertFalse(PasswordHelper::isSecure('12345678'));

        // Senhas seguras
        $this->assertTrue(PasswordHelper::isSecure('Password123'));
        $this->assertTrue(PasswordHelper::isSecure('P@ssw0rd'));
        $this->assertTrue(PasswordHelper::isSecure('Secure_P@ssw0rd'));

        // Com nível de segurança personalizado
        $this->assertTrue(PasswordHelper::isSecure('password', 1));
        $this->assertFalse(PasswordHelper::isSecure('password', 4));
        $this->assertTrue(PasswordHelper::isSecure('P@ssw0rd', 5));
        $this->assertFalse(PasswordHelper::isSecure('P@ssw0rd', 6));
    }
}
