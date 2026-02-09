<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Criar papéis e permissões para testes
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Criar permissões básicas para teste
        Permission::create(['name' => 'user.view']);
        Permission::create(['name' => 'role.view']);

        // Criar papéis para teste
        $sysadminRole = Role::create(['name' => 'sysadmin']);
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Atribuir permissões aos papéis
        $sysadminRole->givePermissionTo(Permission::all());
        $adminRole->givePermissionTo('user.view');
    }

    /**
     * Teste para verificar se usuário não autenticado é redirecionado para login.
     */
    public function test_unauthenticated_user_is_redirected_to_login(): void
    {
        $response = $this->get('/admin/users');

        $response->assertRedirect('/login');
    }

    /**
     * Teste para verificar se usuário sysadmin pode acessar área administrativa.
     */
    public function test_sysadmin_can_access_admin_area(): void
    {
        // Criar usuário com papel sysadmin
        $user = User::factory()->create();
        $user->assignRole('sysadmin');

        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertStatus(200);
    }

    /**
     * Teste para verificar se usuário admin pode acessar área de usuários.
     */
    public function test_admin_can_access_users_area(): void
    {
        // Criar usuário com papel admin
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertStatus(200);
    }

    /**
     * Teste para verificar se usuário comum não pode acessar área administrativa.
     */
    public function test_regular_user_cannot_access_admin_area(): void
    {
        // Criar usuário com papel user
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertStatus(302);
    }

    /**
     * Teste para verificar se usuário sem papel específico não pode acessar área restrita.
     */
    public function test_user_without_specific_role_cannot_access_restricted_area(): void
    {
        // Criar usuário com papel admin
        $user = User::factory()->create();

        // Tentar acessar área de gerenciamento de papéis (somente sysadmin)
        $response = $this->actingAs($user)->get('/sysadmin/roles');

        $response->assertStatus(302);
    }
}
