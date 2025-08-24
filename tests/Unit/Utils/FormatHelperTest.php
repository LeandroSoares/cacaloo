<?php

namespace Tests\Unit\Utils;

use App\Utils\FormatHelper;
use PHPUnit\Framework\TestCase;

class FormatHelperTest extends TestCase
{
    /**
     * Testa a formatação de moeda.
     */
    public function test_currency()
    {
        // Com símbolo
        $this->assertEquals('R$ 1.234,56', FormatHelper::currency(1234.56));

        // Sem símbolo
        $this->assertEquals('1.234,56', FormatHelper::currency(1234.56, false));

        // Valor negativo
        $this->assertEquals('R$ -1.234,56', FormatHelper::currency(-1234.56));
    }

    /**
     * Testa a formatação de porcentagem.
     */
    public function test_percentage()
    {
        // Padrão com 2 casas decimais
        $this->assertEquals('10,50%', FormatHelper::percentage(10.5));

        // Com 1 casa decimal
        $this->assertEquals('10,5%', FormatHelper::percentage(10.5, 1));

        // Sem casas decimais
        $this->assertEquals('11%', FormatHelper::percentage(10.5, 0));
    }

    /**
     * Testa a formatação de telefone.
     */
    public function test_phone()
    {
        // Celular com DDD
        $this->assertEquals('(11) 98765-4321', FormatHelper::phone('11987654321'));
        $this->assertEquals('(11) 98765-4321', FormatHelper::phone('(11) 98765-4321'));

        // Telefone fixo com DDD
        $this->assertEquals('(11) 3456-7890', FormatHelper::phone('1134567890'));
        $this->assertEquals('(11) 3456-7890', FormatHelper::phone('(11) 3456-7890'));

        // Celular sem DDD
        $this->assertEquals('98765-4321', FormatHelper::phone('987654321'));

        // Telefone fixo sem DDD
        $this->assertEquals('3456-7890', FormatHelper::phone('34567890'));

        // Número fora do padrão
        $this->assertEquals('123', FormatHelper::phone('123'));
    }

    /**
     * Testa a formatação de CPF.
     */
    public function test_cpf()
    {
        // CPF válido
        $this->assertEquals('123.456.789-09', FormatHelper::cpf('12345678909'));
        $this->assertEquals('123.456.789-09', FormatHelper::cpf('123.456.789-09'));

        // CPF inválido (número incorreto de dígitos)
        $this->assertEquals('1234567890', FormatHelper::cpf('1234567890'));
    }

    /**
     * Testa a formatação de CNPJ.
     */
    public function test_cnpj()
    {
        // CNPJ válido
        $this->assertEquals('12.345.678/0001-90', FormatHelper::cnpj('12345678000190'));
        $this->assertEquals('12.345.678/0001-90', FormatHelper::cnpj('12.345.678/0001-90'));

        // CNPJ inválido (número incorreto de dígitos)
        $this->assertEquals('1234567800019', FormatHelper::cnpj('1234567800019'));
    }

    /**
     * Testa a formatação de data.
     */
    public function test_date()
    {
        // Data padrão
        $this->assertEquals('01/01/2023', FormatHelper::date('2023-01-01'));

        // Data com formato personalizado
        $this->assertEquals('01-01-2023', FormatHelper::date('2023-01-01', 'Y-m-d', 'd-m-Y'));

        // Data inválida (retorna a original)
        $this->assertEquals('01/01/2024', FormatHelper::date('2023-13-01'));
    }
}
