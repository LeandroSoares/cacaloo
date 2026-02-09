<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Cache;

/**
 * Trait para cache de Models com dados estáticos.
 *
 * Adiciona método getAllCached() e limpa cache automaticamente no boot.
 */
trait CacheableModel
{
    /**
     * Retorna todos os registros com cache (limpa automaticamente ao alterar)
     */
    public static function getAllCached()
    {
        $cacheKey = self::getCacheKey();

        return Cache::rememberForever($cacheKey, function () {
            // Verifica se o model tem coluna 'active'
            $query = self::query();

            // Check if column active exists dynamically or assume active exists
            // Para simplificar, vamos assumir que se usa esse trait, deve ter active se quiser filtrar
            // Mas melhor ser genérico: apenas retornar all() se não especificar ordem

            if (in_array('active', (new static)->getFillable())) {
                $query->where('active', true);
            }

            if (in_array('name', (new static)->getFillable())) {
                $query->orderBy('name');
            }

            return $query->get();
        });
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget(self::getCacheKey());
        });

        static::deleted(function () {
            Cache::forget(self::getCacheKey());
        });
    }

    private static function getCacheKey(): string
    {
        return strtolower(class_basename(static::class)).'.all';
    }
}
