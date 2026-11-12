<?php

use App\Models\FeatureFlag;

if (! function_exists('feature_enabled')) {
    /**
     * Verifica se uma feature flag está habilitada
     */
    function feature_enabled(string $key): bool
    {
        return FeatureFlag::isEnabled($key);
    }
}
