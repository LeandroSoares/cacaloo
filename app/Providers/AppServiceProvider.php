<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Prevenir lazy loading em desenvolvimento (detecta N+1 queries)
        Model::preventLazyLoading(! app()->isProduction());

        // Em desenvolvimento, lançar exceção para mass assignment e atributos inexistentes
        Model::shouldBeStrict(! app()->isProduction());

        Gate::after(function ($user, string $ability, ?bool $result) {
            if ($ability === 'library.manage' && ! $result) {
                return method_exists($user, 'hasRole') && $user->hasRole(['admin', 'sysadmin']);
            }

            return $result;
        });
    }
}
