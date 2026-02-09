<?php

if (! function_exists('feature_enabled')) {
    /**
     * Verifica se uma feature flag está habilitada
     */
    function feature_enabled(string $key): bool
    {
        return \App\Models\FeatureFlag::isEnabled($key);
    }
}
