<?php

namespace Tests\Unit\Utils;

use App\Utils\DateHelper;
use DateTime;
use DateTimeZone;
use PHPUnit\Framework\TestCase;

class DateHelperTest extends TestCase
{
    /**
     * Testa a formatação de data.
     */
    public function test_format()
    {
        // Testa com string
        $this->assertEquals('01/01/2023', DateHelper::format('2023-01-01'));

        // Testa com DateTime
        $date = new DateTime('2023-01-01');
        $this->assertEquals('01/01/2023', DateHelper::format($date));

        // Testa com formato personalizado
        $this->assertEquals('01-01-2023', DateHelper::format('2023-01-01', 'd-m-Y'));

        // Testa com data inválida
        $this->assertEquals('', DateHelper::format('invalid-date'));
    }

    /**
     * Testa a diferença em dias entre duas datas.
     */
    public function test_diff_in_days()
    {
        // Testa com strings
        $this->assertEquals(1, DateHelper::diffInDays('2023-01-01', '2023-01-02'));
        $this->assertEquals(31, DateHelper::diffInDays('2023-01-01', '2023-02-01'));

        // Testa com DateTime
        $date1 = new DateTime('2023-01-01');
        $date2 = new DateTime('2023-01-10');
        $this->assertEquals(9, DateHelper::diffInDays($date1, $date2));

        // Testa com string e DateTime
        $this->assertEquals(9, DateHelper::diffInDays($date1, '2023-01-10'));
        $this->assertEquals(9, DateHelper::diffInDays('2023-01-01', $date2));

        // Testa com datas inválidas
        $this->assertEquals(0, DateHelper::diffInDays('invalid-date', '2023-01-01'));
        $this->assertEquals(0, DateHelper::diffInDays('2023-01-01', 'invalid-date'));
    }

    /**
     * Testa se uma data é posterior a outra.
     */
    public function test_is_after()
    {
        // Testa com strings
        $this->assertTrue(DateHelper::isAfter('2023-01-02', '2023-01-01'));
        $this->assertFalse(DateHelper::isAfter('2023-01-01', '2023-01-02'));

        // Testa com DateTime
        $date1 = new DateTime('2023-01-10');
        $date2 = new DateTime('2023-01-01');
        $this->assertTrue(DateHelper::isAfter($date1, $date2));

        // Testa com string e DateTime
        $this->assertTrue(DateHelper::isAfter($date1, '2023-01-01'));
        $this->assertTrue(DateHelper::isAfter('2023-01-10', $date2));

        // Testa com mesma data
        $this->assertFalse(DateHelper::isAfter('2023-01-01', '2023-01-01'));

        // Testa com datas inválidas
        $this->assertFalse(DateHelper::isAfter('invalid-date', '2023-01-01'));
        $this->assertFalse(DateHelper::isAfter('2023-01-01', 'invalid-date'));
    }

    /**
     * Testa a adição de dias a uma data.
     */
    public function test_add_days()
    {
        // Testa com string
        $result = DateHelper::addDays('2023-01-01', 5);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertEquals('2023-01-06', $result->format('Y-m-d'));

        // Testa com DateTime
        $date = new DateTime('2023-01-01');
        $result = DateHelper::addDays($date, 10);
        $this->assertEquals('2023-01-11', $result->format('Y-m-d'));

        // Testa com data inválida
        $result = DateHelper::addDays('invalid-date', 5);
        $this->assertInstanceOf(DateTime::class, $result);
    }

    /**
     * Testa a conversão de fuso horário.
     */
    public function test_convert_timezone()
    {
        // Testa com string
        $result = DateHelper::convertTimezone('2023-01-01 12:00:00', 'UTC', 'America/Sao_Paulo');
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertEquals('America/Sao_Paulo', $result->getTimezone()->getName());

        // A diferença entre UTC e São Paulo é -3 horas
        $this->assertEquals('2023-01-01 09:00:00', $result->format('Y-m-d H:i:s'));

        // Testa com DateTime
        $date = new DateTime('2023-01-01 12:00:00', new DateTimeZone('UTC'));
        $result = DateHelper::convertTimezone($date, 'UTC', 'America/New_York');
        $this->assertEquals('America/New_York', $result->getTimezone()->getName());

        // Testa com data inválida
        $result = DateHelper::convertTimezone('invalid-date', 'UTC', 'America/Sao_Paulo');
        $this->assertInstanceOf(DateTime::class, $result);
    }
}
