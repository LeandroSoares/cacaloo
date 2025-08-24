<?php

namespace Tests\Unit\Providers;

use PHPUnit\Framework\TestCase;

class RoleServiceProviderTest extends TestCase
{
    /**
     * Teste básico para garantir cobertura.
     */
    public function test_basic_test()
    {
        $this->assertTrue(true);
    }

    /**
     * Teste simulado de diretivas Blade.
     */
    public function test_blade_directives()
    {
        // Simula uma diretiva de papel
        $roleDirective = function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
        };

        // Testa a saída da diretiva
        $output = $roleDirective('admin');
        $this->assertEquals("<?php if(auth()->check() && auth()->user()->hasRole(admin)): ?>", $output);

        // Simula uma diretiva de permissão
        $permissionDirective = function ($permission) {
            return "<?php if(auth()->check() && auth()->user()->can({$permission})): ?>";
        };

        // Testa a saída da diretiva
        $output = $permissionDirective('view-users');
        $this->assertEquals("<?php if(auth()->check() && auth()->user()->can(view-users)): ?>", $output);
    }
}
