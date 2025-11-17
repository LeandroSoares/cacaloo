<?php

if (!function_exists('feature_enabled')) {
    /**
     * Verifica se uma feature flag está habilitada
     *
     * @param string $key
     * @return bool
     */
    function feature_enabled(string $key): bool
    {
        return \App\Models\FeatureFlag::isEnabled($key);
    }
}
