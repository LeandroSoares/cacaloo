<?php

namespace Tests\Unit\Utils;

use App\Utils\JsonHelper;
use PHPUnit\Framework\TestCase;

class JsonHelperTest extends TestCase
{
    /**
     * Testa a codificação para JSON.
     */
    public function test_encode()
    {
        // Array simples
        $array = ['name' => 'John', 'age' => 30];
        $this->assertEquals('{"name":"John","age":30}', JsonHelper::encode($array));

        // Array com opções
        $this->assertEquals("{\n    \"name\": \"John\",\n    \"age\": 30\n}", JsonHelper::encode($array, JSON_PRETTY_PRINT));

        // Objeto
        $object = new \stdClass;
        $object->name = 'John';
        $object->age = 30;
        $this->assertEquals('{"name":"John","age":30}', JsonHelper::encode($object));
    }

    /**
     * Testa a decodificação de JSON.
     */
    public function test_decode()
    {
        // Para objeto
        $json = '{"name":"John","age":30}';
        $result = JsonHelper::decode($json);
        $this->assertIsObject($result);
        $this->assertEquals('John', $result->name);
        $this->assertEquals(30, $result->age);

        // Para array
        $result = JsonHelper::decode($json, true);
        $this->assertIsArray($result);
        $this->assertEquals('John', $result['name']);
        $this->assertEquals(30, $result['age']);
    }

    /**
     * Testa a validação de JSON.
     */
    public function test_is_valid()
    {
        // JSON válido
        $this->assertTrue(JsonHelper::isValid('{"name":"John","age":30}'));
        $this->assertTrue(JsonHelper::isValid('[]'));
        $this->assertTrue(JsonHelper::isValid('null'));

        // JSON inválido
        $this->assertFalse(JsonHelper::isValid(''));
        $this->assertFalse(JsonHelper::isValid('{name:"John"}'));
        $this->assertFalse(JsonHelper::isValid('{"name":"John",}'));
    }

    /**
     * Testa a obtenção do último erro JSON.
     */
    public function test_get_last_error()
    {
        // Sem erro
        JsonHelper::decode('{"name":"John"}');
        $this->assertEquals('', JsonHelper::getLastError());

        // Com erro de sintaxe
        JsonHelper::decode('{"name":"John",}');
        $this->assertEquals('Syntax error, malformed JSON', JsonHelper::getLastError());

        // Com erro de UTF-8
        $invalidUtf8 = '{"name":"'.chr(193).'"}';
        JsonHelper::decode($invalidUtf8);
        $this->assertEquals('Malformed UTF-8 characters, possibly incorrectly encoded', JsonHelper::getLastError());
    }

    /**
     * Testa a formatação de JSON.
     */
    public function test_format()
    {
        // JSON válido
        $json = '{"name":"John","age":30}';
        $expected = "{\n    \"name\": \"John\",\n    \"age\": 30\n}";
        $this->assertEquals($expected, JsonHelper::format($json));

        // JSON inválido
        $invalid = '{"name":"John",}';
        $this->assertEquals($invalid, JsonHelper::format($invalid));
    }
}
