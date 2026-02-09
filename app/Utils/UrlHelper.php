<?php

namespace App\Utils;

class UrlHelper
{
    /**
     * Verifica se uma URL é válida.
     */
    public static function isValid(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Obtém o esquema de uma URL.
     */
    public static function getScheme(string $url): ?string
    {
        if (! self::isValid($url)) {
            return null;
        }

        return parse_url($url, PHP_URL_SCHEME);
    }

    /**
     * Obtém o host de uma URL.
     */
    public static function getHost(string $url): ?string
    {
        if (! self::isValid($url)) {
            return null;
        }

        return parse_url($url, PHP_URL_HOST);
    }

    /**
     * Obtém o caminho de uma URL.
     */
    public static function getPath(string $url): ?string
    {
        if (! self::isValid($url)) {
            return null;
        }

        return parse_url($url, PHP_URL_PATH) ?: '/';
    }

    /**
     * Obtém a query string de uma URL.
     */
    public static function getQuery(string $url): ?string
    {
        if (! self::isValid($url)) {
            return null;
        }

        return parse_url($url, PHP_URL_QUERY);
    }

    /**
     * Obtém um parâmetro da query string.
     */
    public static function getQueryParam(string $url, string $param): ?string
    {
        $query = self::getQuery($url);

        if ($query === null) {
            return null;
        }

        parse_str($query, $params);

        return $params[$param] ?? null;
    }

    /**
     * Constrói uma URL com parâmetros de query string.
     */
    public static function buildQuery(string $url, array $params): string
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            return $url;
        }

        $parsedUrl = parse_url($url);

        if (! $parsedUrl) {
            return $url;
        }

        $scheme = $parsedUrl['scheme'] ?? 'http';
        $host = $parsedUrl['host'] ?? '';
        $port = isset($parsedUrl['port']) ? ":{$parsedUrl['port']}" : '';
        $user = $parsedUrl['user'] ?? '';
        $pass = isset($parsedUrl['pass']) ? ":{$parsedUrl['pass']}" : '';
        $userinfo = $user ? "{$user}{$pass}@" : '';
        $path = $parsedUrl['path'] ?? '';
        $query = $parsedUrl['query'] ?? '';
        $fragment = isset($parsedUrl['fragment']) ? "#{$parsedUrl['fragment']}" : '';

        if ($query) {
            parse_str($query, $queryParams);
            $params = array_merge($queryParams, $params);
        }

        $queryString = http_build_query($params);

        return "{$scheme}://{$userinfo}{$host}{$port}{$path}".($queryString ? "?{$queryString}" : '').$fragment;
    }
}
