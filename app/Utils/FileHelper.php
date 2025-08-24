<?php

namespace App\Utils;

class FileHelper
{
    /**
     * Obtém a extensão de um arquivo.
     *
     * @param string $filename
     * @return string
     */
    public static function getExtension(string $filename): string
    {
        return pathinfo($filename, PATHINFO_EXTENSION);
    }

    /**
     * Verifica se um arquivo existe.
     *
     * @param string $path
     * @return bool
     */
    public static function exists(string $path): bool
    {
        return file_exists($path);
    }

    /**
     * Formata o tamanho de um arquivo para uma unidade legível.
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    public static function formatSize(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Cria um diretório se ele não existir.
     *
     * @param string $path
     * @param int $permissions
     * @param bool $recursive
     * @return bool
     */
    public static function makeDirectory(string $path, int $permissions = 0755, bool $recursive = true): bool
    {
        if (!is_dir($path)) {
            return mkdir($path, $permissions, $recursive);
        }

        return true;
    }

    /**
     * Determina o tipo MIME de um arquivo.
     *
     * @param string $path
     * @return string|false
     */
    public static function getMimeType(string $path): string|false
    {
        if (!file_exists($path)) {
            return false;
        }

        if (function_exists('mime_content_type')) {
            return mime_content_type($path);
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $path);
        finfo_close($finfo);

        return $mimeType;
    }
}
