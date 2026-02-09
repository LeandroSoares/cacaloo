<?php

namespace App\Utils;

class FormatHelper
{
    /**
     * Formata um número como moeda brasileira.
     */
    public static function currency(float $value, bool $showSymbol = true): string
    {
        $formatted = number_format($value, 2, ',', '.');

        return $showSymbol ? "R$ {$formatted}" : $formatted;
    }

    /**
     * Formata um número como porcentagem.
     */
    public static function percentage(float $value, int $decimals = 2): string
    {
        return number_format($value, $decimals, ',', '.').'%';
    }

    /**
     * Formata um número de telefone brasileiro.
     */
    public static function phone(string $phone): string
    {
        // Remove todos os caracteres não numéricos
        $phone = preg_replace('/[^0-9]/', '', $phone);

        $length = strlen($phone);

        if ($length === 11) {
            // Celular com DDD: (99) 99999-9999
            return sprintf('(%s) %s-%s',
                substr($phone, 0, 2),
                substr($phone, 2, 5),
                substr($phone, 7)
            );
        }

        if ($length === 10) {
            // Telefone fixo com DDD: (99) 9999-9999
            return sprintf('(%s) %s-%s',
                substr($phone, 0, 2),
                substr($phone, 2, 4),
                substr($phone, 6)
            );
        }

        if ($length === 9) {
            // Celular sem DDD: 99999-9999
            return sprintf('%s-%s',
                substr($phone, 0, 5),
                substr($phone, 5)
            );
        }

        if ($length === 8) {
            // Telefone fixo sem DDD: 9999-9999
            return sprintf('%s-%s',
                substr($phone, 0, 4),
                substr($phone, 4)
            );
        }

        // Retorna o número original se não se encaixar em nenhum formato conhecido
        return $phone;
    }

    /**
     * Formata um CPF.
     */
    public static function cpf(string $cpf): string
    {
        // Remove todos os caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) !== 11) {
            return $cpf;
        }

        return sprintf('%s.%s.%s-%s',
            substr($cpf, 0, 3),
            substr($cpf, 3, 3),
            substr($cpf, 6, 3),
            substr($cpf, 9)
        );
    }

    /**
     * Formata um CNPJ.
     */
    public static function cnpj(string $cnpj): string
    {
        // Remove todos os caracteres não numéricos
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        if (strlen($cnpj) !== 14) {
            return $cnpj;
        }

        return sprintf('%s.%s.%s/%s-%s',
            substr($cnpj, 0, 2),
            substr($cnpj, 2, 3),
            substr($cnpj, 5, 3),
            substr($cnpj, 8, 4),
            substr($cnpj, 12)
        );
    }

    /**
     * Formata uma data para o formato brasileiro.
     */
    public static function date(string $date, string $fromFormat = 'Y-m-d', string $toFormat = 'd/m/Y'): string
    {
        $dateTime = \DateTime::createFromFormat($fromFormat, $date);

        if (! $dateTime) {
            return $date;
        }

        return $dateTime->format($toFormat);
    }
}
