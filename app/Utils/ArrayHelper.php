<?php

namespace App\Utils;

class ArrayHelper
{
    /**
     * Verifica se um array é associativo.
     */
    public static function isAssociative(array $array): bool
    {
        if (empty($array)) {
            return false;
        }

        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * Filtra um array mantendo apenas os valores não vazios.
     */
    public static function filterEmpty(array $array): array
    {
        return array_filter($array, fn ($value) => ! empty($value));
    }

    /**
     * Obtém um valor de um array usando notação de ponto.
     */
    public static function get(array $array, string $key, mixed $default = null): mixed
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        if (! str_contains($key, '.')) {
            return $default;
        }

        $keys = explode('.', $key);

        foreach ($keys as $segment) {
            if (! is_array($array) || ! array_key_exists($segment, $array)) {
                return $default;
            }

            $array = $array[$segment];
        }

        return $array;
    }

    /**
     * Aplica uma função a cada elemento do array e retorna um novo array.
     */
    public static function map(array $array, callable $callback): array
    {
        return array_map($callback, $array);
    }

    /**
     * Converte um array para uma string delimitada.
     */
    public static function implode(array $array, string $delimiter = ', '): string
    {
        return implode($delimiter, $array);
    }
}
