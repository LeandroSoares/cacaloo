<?php

namespace App\Utils;

class PasswordHelper
{
    /**
     * Gera um hash seguro para uma senha.
     *
     * @param string $password
     * @return string
     */
    public static function hash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    /**
     * Verifica se uma senha corresponde a um hash.
     *
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public static function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Verifica se um hash precisa ser atualizado.
     *
     * @param string $hash
     * @return bool
     */
    public static function needsRehash(string $hash): bool
    {
        return password_needs_rehash($hash, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    /**
     * Gera uma senha aleatória.
     *
     * @param int $length
     * @param bool $includeSpecialChars
     * @return string
     */
    public static function generate(int $length = 12, bool $includeSpecialChars = true): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        if ($includeSpecialChars) {
            $chars .= '!@#$%^&*()_-+={}[]|:;<>,.?/~';
        }

        $password = '';
        $max = strlen($chars) - 1;

        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, $max)];
        }

        return $password;
    }

    /**
     * Avalia a força de uma senha.
     *
     * @param string $password
     * @return int
     */
    public static function strength(string $password): int
    {
        $strength = 0;
        $length = strlen($password);

        // Comprimento mínimo de 8 caracteres
        if ($length >= 8) {
            $strength += 1;
        }

        // Comprimento mínimo de 12 caracteres
        if ($length >= 12) {
            $strength += 1;
        }

        // Contém letras minúsculas
        if (preg_match('/[a-z]/', $password)) {
            $strength += 1;
        }

        // Contém letras maiúsculas
        if (preg_match('/[A-Z]/', $password)) {
            $strength += 1;
        }

        // Contém números
        if (preg_match('/[0-9]/', $password)) {
            $strength += 1;
        }

        // Contém caracteres especiais
        if (preg_match('/[^a-zA-Z0-9]/', $password)) {
            $strength += 1;
        }

        return $strength;
    }

    /**
     * Verifica se uma senha é segura.
     *
     * @param string $password
     * @param int $minStrength
     * @return bool
     */
    public static function isSecure(string $password, int $minStrength = 4): bool
    {
        return self::strength($password) >= $minStrength;
    }
}
