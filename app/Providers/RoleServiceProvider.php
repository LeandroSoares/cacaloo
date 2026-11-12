<?php

namespace App\Providers;

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Registrar middleware aliased
        $router = $this->app['router'];
        $router->aliasMiddleware('role', CheckRole::class);
        $router->aliasMiddleware('permission', PermissionMiddleware::class);
        $router->aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);

        // Adicionar diretivas Blade para verificação de papéis e permissões
        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });

        Blade::directive('endrole', function () {
            return '<?php endif; ?>';
        });

        Blade::directive('permission', function ($permission) {
            return "<?php if(auth()->check() && auth()->user()->can({$permission})): ?>";
        });

        Blade::directive('endpermission', function () {
            return '<?php endif; ?>';
        });

        // Registrar gate para sysadmin
        Gate::before(function ($user, $ability) {
            return $user->hasRole('sysadmin') ? true : null;
        });
    }
}
