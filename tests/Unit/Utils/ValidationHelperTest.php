<?php

namespace Tests\Unit\Utils;

use App\Utils\ValidationHelper;
use PHPUnit\Framework\TestCase;

class ValidationHelperTest extends TestCase
{
    /**
     * Testa a validação de email.
     */
    public function test_is_email()
    {
        // Email válido
        $this->assertTrue(ValidationHelper::isEmail('test@example.com'));

        // Email inválido
        $this->assertFalse(ValidationHelper::isEmail('test@example'));
        $this->assertFalse(ValidationHelper::isEmail('test.example.com'));
        $this->assertFalse(ValidationHelper::isEmail('test@.com'));
    }

    /**
     * Testa a validação de URL.
     */
    public function test_is_url()
    {
        // URL válido
        $this->assertTrue(ValidationHelper::isUrl('https://example.com'));
        $this->assertTrue(ValidationHelper::isUrl('http://example.com/path'));

        // URL inválido
        $this->assertFalse(ValidationHelper::isUrl('example.com'));
        $this->assertFalse(ValidationHelper::isUrl('http://'));
    }

    /**
     * Testa a validação de string alfabética.
     */
    public function test_is_alpha()
    {
        // String alfabética
        $this->assertTrue(ValidationHelper::isAlpha('abc'));
        $this->assertTrue(ValidationHelper::isAlpha('ABC'));

        // String não alfabética
        $this->assertFalse(ValidationHelper::isAlpha('abc123'));
        $this->assertFalse(ValidationHelper::isAlpha('abc-def'));
        $this->assertFalse(ValidationHelper::isAlpha('abc def'));
    }

    /**
     * Testa a validação de string alfanumérica.
     */
    public function test_is_alpha_numeric()
    {
        // String alfanumérica
        $this->assertTrue(ValidationHelper::isAlphaNumeric('abc123'));
        $this->assertTrue(ValidationHelper::isAlphaNumeric('ABC123'));

        // String não alfanumérica
        $this->assertFalse(ValidationHelper::isAlphaNumeric('abc-123'));
        $this->assertFalse(ValidationHelper::isAlphaNumeric('abc 123'));
    }

    /**
     * Testa a validação de string numérica.
     */
    public function test_is_numeric()
    {
        // String numérica
        $this->assertTrue(ValidationHelper::isNumeric('123'));
        $this->assertTrue(ValidationHelper::isNumeric('123.45'));

        // String não numérica
        $this->assertFalse(ValidationHelper::isNumeric('abc'));
        $this->assertFalse(ValidationHelper::isNumeric('123abc'));
    }

    /**
     * Testa a validação de data.
     */
    public function test_is_date()
    {
        // Data válida
        $this->assertTrue(ValidationHelper::isDate('2023-01-01'));

        // Data válida com formato personalizado
        $this->assertTrue(ValidationHelper::isDate('01/01/2023', 'd/m/Y'));

        // Data inválida
        $this->assertFalse(ValidationHelper::isDate('2023-13-01'));
        $this->assertFalse(ValidationHelper::isDate('2023-01-32'));

        // Data inválida com formato personalizado
        $this->assertFalse(ValidationHelper::isDate('32/01/2023', 'd/m/Y'));
    }
}
