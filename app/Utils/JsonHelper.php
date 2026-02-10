<?php

namespace App\Utils;

class JsonHelper
{
    /**
     * Converte um objeto ou array para JSON.
     */
    public static function encode(mixed $data, int $options = 0): string
    {
        return json_encode($data, $options);
    }

    /**
     * Converte um JSON para objeto ou array.
     */
    public static function decode(string $json, bool $assoc = false): mixed
    {
        return json_decode($json, $assoc);
    }

    /**
     * Verifica se uma string é um JSON válido.
     */
    public static function isValid(string $json): bool
    {
        if (empty($json)) {
            return false;
        }

        @json_decode($json);

        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Obtém o erro da última operação JSON.
     */
    public static function getLastError(): string
    {
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return '';
            case JSON_ERROR_DEPTH:
                return 'Maximum stack depth exceeded';
            case JSON_ERROR_STATE_MISMATCH:
                return 'Underflow or the modes mismatch';
            case JSON_ERROR_CTRL_CHAR:
                return 'Unexpected control character found';
            case JSON_ERROR_SYNTAX:
                return 'Syntax error, malformed JSON';
            case JSON_ERROR_UTF8:
                return 'Malformed UTF-8 characters, possibly incorrectly encoded';
            default:
                return 'Unknown error';
        }
    }

    /**
     * Formata um JSON para facilitar a leitura.
     */
    public static function format(string $json): string
    {
        if (! self::isValid($json)) {
            return $json;
        }

        $result = json_encode(json_decode($json), JSON_PRETTY_PRINT);

        return $result ?: $json;
    }
}
