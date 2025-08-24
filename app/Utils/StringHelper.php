<?php

namespace App\Utils;

class StringHelper
{
    /**
     * Converte a primeira letra de cada palavra para maiúscula.
     *
     * @param string $string
     * @return string
     */
    public static function titleCase(string $string): string
    {
        return ucwords(strtolower($string));
    }

    /**
     * Remove caracteres especiais de uma string.
     *
     * @param string $string
     * @return string
     */
    public static function removeSpecialChars(string $string): string
    {
        return preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
    }

    /**
     * Limita uma string a um determinado número de caracteres.
     *
     * @param string $string
     * @param int $limit
     * @param string $end
     * @return string
     */
    public static function limit(string $string, int $limit = 100, string $end = '...'): string
    {
        if (mb_strlen($string) <= $limit) {
            return $string;
        }

        return mb_substr($string, 0, $limit) . $end;
    }

    /**
     * Converte uma string para slug.
     *
     * @param string $string
     * @return string
     */
    public static function slug(string $string): string
    {
        $string = self::removeSpecialChars($string);
        $string = strtolower($string);
        return str_replace(' ', '-', trim($string));
    }

    /**
     * Verifica se uma string contém outra string.
     *
     * @param string $haystack
     * @param string|array $needles
     * @return bool
     */
    public static function contains(string $haystack, string|array $needles): bool
    {
        if (is_string($needles)) {
            return str_contains($haystack, $needles);
        }

        foreach ($needles as $needle) {
            if (str_contains($haystack, $needle)) {
                return true;
            }
        }

        return false;
    }
}
