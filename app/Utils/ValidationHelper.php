<?php

namespace App\Utils;

class ValidationHelper
{
    /**
     * Verifica se uma string é um email válido.
     */
    public static function isEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Verifica se uma string é um URL válido.
     */
    public static function isUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Verifica se uma string contém apenas letras.
     */
    public static function isAlpha(string $string): bool
    {
        return preg_match('/^[a-zA-Z]+$/', $string) === 1;
    }

    /**
     * Verifica se uma string contém apenas letras e números.
     */
    public static function isAlphaNumeric(string $string): bool
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $string) === 1;
    }

    /**
     * Verifica se uma string contém apenas números.
     */
    public static function isNumeric(string $string): bool
    {
        return is_numeric($string);
    }

    /**
     * Verifica se uma data está no formato especificado.
     */
    public static function isDate(string $date, string $format = 'Y-m-d'): bool
    {
        $dateTime = \DateTime::createFromFormat($format, $date);

        return $dateTime && $dateTime->format($format) === $date;
    }
}
