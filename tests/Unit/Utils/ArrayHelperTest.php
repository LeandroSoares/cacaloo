<?php

namespace Tests\Unit\Utils;

use App\Utils\ArrayHelper;
use PHPUnit\Framework\TestCase;

class ArrayHelperTest extends TestCase
{
    /**
     * Testa a verificação de array associativo.
     */
    public function test_is_associative()
    {
        // Array associativo
        $array = ['name' => 'John', 'age' => 30];
        $this->assertTrue(ArrayHelper::isAssociative($array));

        // Array sequencial
        $array = ['apple', 'orange', 'banana'];
        $this->assertFalse(ArrayHelper::isAssociative($array));

        // Array vazio
        $array = [];
        $this->assertFalse(ArrayHelper::isAssociative($array));
    }

    /**
     * Testa a filtragem de valores vazios.
     */
    public function test_filter_empty()
    {
        $array = [
            'name' => 'John',
            'email' => '',
            'age' => 30,
            'address' => null,
            'phone' => '123456789',
        ];

        $result = ArrayHelper::filterEmpty($array);

        $expected = [
            'name' => 'John',
            'age' => 30,
            'phone' => '123456789',
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * Testa a obtenção de valores com notação de ponto.
     */
    public function test_get()
    {
        $array = [
            'user' => [
                'name' => 'John',
                'address' => [
                    'city' => 'New York',
                    'country' => 'USA',
                ],
            ],
            'status' => 'active',
        ];

        // Chave simples
        $this->assertEquals('active', ArrayHelper::get($array, 'status'));

        // Chave aninhada
        $this->assertEquals('John', ArrayHelper::get($array, 'user.name'));
        $this->assertEquals('New York', ArrayHelper::get($array, 'user.address.city'));

        // Chave inexistente
        $this->assertNull(ArrayHelper::get($array, 'user.age'));

        // Chave inexistente com valor padrão
        $this->assertEquals(30, ArrayHelper::get($array, 'user.age', 30));

        // Chave inexistente aninhada
        $this->assertNull(ArrayHelper::get($array, 'user.address.street'));
    }

    /**
     * Testa o mapeamento de array.
     */
    public function test_map()
    {
        $array = [1, 2, 3, 4, 5];

        $result = ArrayHelper::map($array, fn ($value) => $value * 2);

        $this->assertEquals([2, 4, 6, 8, 10], $result);
    }

    /**
     * Testa a implode de array.
     */
    public function test_implode()
    {
        $array = ['apple', 'orange', 'banana'];

        // Delimitador padrão
        $this->assertEquals('apple, orange, banana', ArrayHelper::implode($array));

        // Delimitador personalizado
        $this->assertEquals('apple|orange|banana', ArrayHelper::implode($array, '|'));
    }
}
