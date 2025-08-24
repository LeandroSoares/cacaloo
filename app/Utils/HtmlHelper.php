<?php

namespace App\Utils;

class HtmlHelper
{
    /**
     * Converte caracteres especiais em entidades HTML.
     *
     * @param string $string
     * @return string
     */
    public static function escape(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Cria um link HTML.
     *
     * @param string $url
     * @param string $text
     * @param array $attributes
     * @return string
     */
    public static function link(string $url, string $text, array $attributes = []): string
    {
        $escapedUrl = self::escape($url);
        $escapedText = self::escape($text);

        $html = "<a href=\"{$escapedUrl}\"";

        foreach ($attributes as $name => $value) {
            $escapedName = self::escape($name);
            $escapedValue = self::escape($value);
            $html .= " {$escapedName}=\"{$escapedValue}\"";
        }

        $html .= ">{$escapedText}</a>";

        return $html;
    }

    /**
     * Cria uma imagem HTML.
     *
     * @param string $src
     * @param string $alt
     * @param array $attributes
     * @return string
     */
    public static function image(string $src, string $alt = '', array $attributes = []): string
    {
        $escapedSrc = self::escape($src);
        $escapedAlt = self::escape($alt);

        $html = "<img src=\"{$escapedSrc}\" alt=\"{$escapedAlt}\"";

        foreach ($attributes as $name => $value) {
            $escapedName = self::escape($name);
            $escapedValue = self::escape($value);
            $html .= " {$escapedName}=\"{$escapedValue}\"";
        }

        $html .= ">";

        return $html;
    }

    /**
     * Cria uma lista HTML.
     *
     * @param array $items
     * @param string $type
     * @param array $attributes
     * @return string
     */
    public static function list(array $items, string $type = 'ul', array $attributes = []): string
    {
        $type = in_array($type, ['ul', 'ol']) ? $type : 'ul';

        $html = "<{$type}";

        foreach ($attributes as $name => $value) {
            $escapedName = self::escape($name);
            $escapedValue = self::escape($value);
            $html .= " {$escapedName}=\"{$escapedValue}\"";
        }

        $html .= ">";

        foreach ($items as $item) {
            $escapedItem = self::escape($item);
            $html .= "<li>{$escapedItem}</li>";
        }

        $html .= "</{$type}>";

        return $html;
    }

    /**
     * Cria uma tabela HTML.
     *
     * @param array $headers
     * @param array $rows
     * @param array $attributes
     * @return string
     */
    public static function table(array $headers, array $rows, array $attributes = []): string
    {
        $html = "<table";

        foreach ($attributes as $name => $value) {
            $escapedName = self::escape($name);
            $escapedValue = self::escape($value);
            $html .= " {$escapedName}=\"{$escapedValue}\"";
        }

        $html .= ">";

        // Cabeçalho
        if (!empty($headers)) {
            $html .= "<thead><tr>";

            foreach ($headers as $header) {
                $escapedHeader = self::escape($header);
                $html .= "<th>{$escapedHeader}</th>";
            }

            $html .= "</tr></thead>";
        }

        // Linhas
        if (!empty($rows)) {
            $html .= "<tbody>";

            foreach ($rows as $row) {
                $html .= "<tr>";

                foreach ($row as $cell) {
                    $escapedCell = self::escape($cell);
                    $html .= "<td>{$escapedCell}</td>";
                }

                $html .= "</tr>";
            }

            $html .= "</tbody>";
        }

        $html .= "</table>";

        return $html;
    }
}
