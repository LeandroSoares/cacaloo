<?php

namespace Tests\Unit\Utils;

use App\Utils\NumberHelper;
use PHPUnit\Framework\TestCase;

class NumberHelperTest extends TestCase
{
    /**
     * Testa a formatação de números.
     */
    public function test_format()
    {
        // Formatação padrão (2 casas decimais, vírgula como separador decimal, ponto como separador de milhar)
        $this->assertEquals('1.234,56', NumberHelper::format(1234.56));

        // Sem casas decimais
        $this->assertEquals('1.235', NumberHelper::format(1234.56, 0));

        // Com 3 casas decimais
        $this->assertEquals('1.234,560', NumberHelper::format(1234.56, 3));

        // Com separadores personalizados
        $this->assertEquals('1,234.56', NumberHelper::format(1234.56, 2, '.', ','));
    }

    /**
     * Testa o arredondamento para cima.
     */
    public function test_ceil()
    {
        // Arredondamento padrão (sem casas decimais)
        $this->assertEquals(2.0, NumberHelper::ceil(1.1));
        $this->assertEquals(2.0, NumberHelper::ceil(1.9));

        // Com 1 casa decimal
        $this->assertEquals(1.2, NumberHelper::ceil(1.11, 1));
        $this->assertEquals(1.2, NumberHelper::ceil(1.19, 1));

        // Com 2 casas decimais
        $this->assertEquals(1.12, NumberHelper::ceil(1.111, 2));
        $this->assertEquals(1.12, NumberHelper::ceil(1.119, 2));

        // Número negativo
        $this->assertEquals(-1.0, NumberHelper::ceil(-1.9));
        $this->assertEquals(-1.9, NumberHelper::ceil(-1.99, 1));
    }

    /**
     * Testa o arredondamento para baixo.
     */
    public function test_floor()
    {
        // Arredondamento padrão (sem casas decimais)
        $this->assertEquals(1.0, NumberHelper::floor(1.1));
        $this->assertEquals(1.0, NumberHelper::floor(1.9));

        // Com 1 casa decimal
        $this->assertEquals(1.1, NumberHelper::floor(1.19, 1));
        $this->assertEquals(1.1, NumberHelper::floor(1.11, 1));

        // Com 2 casas decimais
        $this->assertEquals(1.11, NumberHelper::floor(1.119, 2));
        $this->assertEquals(1.11, NumberHelper::floor(1.111, 2));

        // Número negativo
        $this->assertEquals(-2.0, NumberHelper::floor(-1.1));
        $this->assertEquals(-2.0, NumberHelper::floor(-1.9));
    }

    /**
     * Testa a verificação de intervalo.
     */
    public function test_in_range()
    {
        // Dentro do intervalo
        $this->assertTrue(NumberHelper::inRange(5, 0, 10));
        $this->assertTrue(NumberHelper::inRange(0, 0, 10));
        $this->assertTrue(NumberHelper::inRange(10, 0, 10));

        // Fora do intervalo
        $this->assertFalse(NumberHelper::inRange(-1, 0, 10));
        $this->assertFalse(NumberHelper::inRange(11, 0, 10));
    }

    /**
     * Testa a limitação de um número.
     */
    public function test_clamp()
    {
        // Dentro do intervalo
        $this->assertEquals(5, NumberHelper::clamp(5, 0, 10));

        // Abaixo do mínimo
        $this->assertEquals(0, NumberHelper::clamp(-5, 0, 10));

        // Acima do máximo
        $this->assertEquals(10, NumberHelper::clamp(15, 0, 10));

        // Igual ao mínimo
        $this->assertEquals(0, NumberHelper::clamp(0, 0, 10));

        // Igual ao máximo
        $this->assertEquals(10, NumberHelper::clamp(10, 0, 10));
    }

    /**
     * Testa o cálculo de porcentagem.
     */
    public function test_percentage()
    {
        // Cálculos básicos
        $this->assertEquals(50.0, NumberHelper::percentage(50, 100));
        $this->assertEquals(25.0, NumberHelper::percentage(25, 100));
        $this->assertEquals(200.0, NumberHelper::percentage(100, 50));

        // Com precisão personalizada
        $this->assertEquals(33.33, NumberHelper::percentage(10, 30, 2));
        $this->assertEquals(33.3, NumberHelper::percentage(10, 30, 1));
        $this->assertEquals(33.0, NumberHelper::percentage(10, 30, 0));

        // Total zero
        $this->assertEquals(0.0, NumberHelper::percentage(10, 0));
    }

    /**
     * Testa a geração de números aleatórios.
     */
    public function test_random()
    {
        // Testa se o número está no intervalo
        for ($i = 0; $i < 100; $i++) {
            $random = NumberHelper::random(1, 10);
            $this->assertGreaterThanOrEqual(1, $random);
            $this->assertLessThanOrEqual(10, $random);
        }

        // Testa se o número é um inteiro
        $random = NumberHelper::random(1, 10);
        $this->assertIsInt($random);
    }
}
