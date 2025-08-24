<?php

namespace App\Utils;

class ValidationHelper
{
    /**
     * Verifica se uma string é um email válido.
     *
     * @param string $email
     * @return bool
     */
    public static function isEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Verifica se uma string é um URL válido.
     *
     * @param string $url
     * @return bool
     */
    public static function isUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Verifica se uma string contém apenas letras.
     *
     * @param string $string
     * @return bool
     */
    public static function isAlpha(string $string): bool
    {
        return preg_match('/^[a-zA-Z]+$/', $string) === 1;
    }

    /**
     * Verifica se uma string contém apenas letras e números.
     *
     * @param string $string
     * @return bool
     */
    public static function isAlphaNumeric(string $string): bool
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $string) === 1;
    }

    /**
     * Verifica se uma string contém apenas números.
     *
     * @param string $string
     * @return bool
     */
    public static function isNumeric(string $string): bool
    {
        return is_numeric($string);
    }

    /**
     * Verifica se uma data está no formato especificado.
     *
     * @param string $date
     * @param string $format
     * @return bool
     */
    public static function isDate(string $date, string $format = 'Y-m-d'): bool
    {
        $dateTime = \DateTime::createFromFormat($format, $date);
        return $dateTime && $dateTime->format($format) === $date;
    }
}
