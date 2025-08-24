<?php

namespace Tests\Unit\Utils;

use App\Utils\StringHelper;
use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase
{
    /**
     * Testa a conversão para title case.
     */
    public function test_title_case()
    {
        $string = 'hello world';
        $result = StringHelper::titleCase($string);
        $this->assertEquals('Hello World', $result);
    }

    /**
     * Testa a remoção de caracteres especiais.
     */
    public function test_remove_special_chars()
    {
        $string = 'Hello, World!';
        $result = StringHelper::removeSpecialChars($string);
        $this->assertEquals('Hello World', $result);
    }

    /**
     * Testa a limitação de caracteres.
     */
    public function test_limit_string()
    {
        // Teste quando a string é menor que o limite
        $string = 'Hello World';
        $result = StringHelper::limit($string, 20);
        $this->assertEquals('Hello World', $result);

        // Teste quando a string é maior que o limite
        $string = 'This is a very long string that should be truncated';
        $result = StringHelper::limit($string, 10);
        $this->assertEquals('This is a ...', $result);

        // Teste com um final personalizado
        $string = 'This is a very long string that should be truncated';
        $result = StringHelper::limit($string, 10, ' (...)');
        $this->assertEquals('This is a  (...)', $result);
    }

    /**
     * Testa a conversão para slug.
     */
    public function test_slug()
    {
        $string = 'Hello World';
        $result = StringHelper::slug($string);
        $this->assertEquals('hello-world', $result);

        $string = 'Hello, World! This is a test';
        $result = StringHelper::slug($string);
        $this->assertEquals('hello-world-this-is-a-test', $result);
    }

    /**
     * Testa o método contains com uma string.
     */
    public function test_contains_with_string()
    {
        $haystack = 'Hello World';

        // Deve retornar true
        $this->assertTrue(StringHelper::contains($haystack, 'World'));

        // Deve retornar false
        $this->assertFalse(StringHelper::contains($haystack, 'Universe'));
    }

    /**
     * Testa o método contains com um array.
     */
    public function test_contains_with_array()
    {
        $haystack = 'Hello World';

        // Deve retornar true (um dos valores está presente)
        $this->assertTrue(StringHelper::contains($haystack, ['Universe', 'World']));

        // Deve retornar false (nenhum valor está presente)
        $this->assertFalse(StringHelper::contains($haystack, ['Universe', 'Galaxy']));
    }
}
