<?php

namespace App\Utils;

class NumberHelper
{
    /**
     * Formata um número com casas decimais e separadores.
     */
    public static function format(float $number, int $decimals = 2, string $decimalSeparator = ',', string $thousandsSeparator = '.'): string
    {
        return number_format($number, $decimals, $decimalSeparator, $thousandsSeparator);
    }

    /**
     * Arredonda um número para cima.
     */
    public static function ceil(float $number, int $precision = 0): float
    {
        $factor = pow(10, $precision);

        return ceil($number * $factor) / $factor;
    }

    /**
     * Arredonda um número para baixo.
     */
    public static function floor(float $number, int $precision = 0): float
    {
        $factor = pow(10, $precision);

        return floor($number * $factor) / $factor;
    }

    /**
     * Verifica se um número está em um intervalo.
     */
    public static function inRange(float $number, float $min, float $max): bool
    {
        return $number >= $min && $number <= $max;
    }

    /**
     * Limita um número a um intervalo.
     */
    public static function clamp(float $number, float $min, float $max): float
    {
        return max($min, min($max, $number));
    }

    /**
     * Calcula uma porcentagem.
     */
    public static function percentage(float $number, float $total, int $precision = 2): float
    {
        if ($total == 0) {
            return 0;
        }

        return round(($number / $total) * 100, $precision);
    }

    /**
     * Gera um número aleatório em um intervalo.
     */
    public static function random(int $min, int $max): int
    {
        return rand($min, $max);
    }
}
