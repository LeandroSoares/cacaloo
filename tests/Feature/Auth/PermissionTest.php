<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Criar papéis e permissões para testes
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Criar permissões para teste
        Permission::create(['name' => 'user.view']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.delete']);

        // Criar papéis com diferentes níveis de permissão
        $sysadminRole = Role::create(['name' => 'sysadmin']);
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);

        // Atribuir permissões aos papéis
        $sysadminRole->givePermissionTo(Permission::all());
        $adminRole->givePermissionTo(['user.view', 'user.create', 'user.edit']);
        $managerRole->givePermissionTo(['user.view']);
    }

    /**
     * Teste para verificar se um usuário com permissão pode ver a lista de usuários.
     */
    public function test_user_with_view_permission_can_see_users_list(): void
    {
        // Criar usuário com papel que tem permissão de visualização
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.index');
    }

    /**
     * Teste para verificar blade directive @role.
     */
    public function test_admin_can_see_admin_menu(): void
    {
        // Criar usuário com papel admin
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Usuários'); // Verifica se o menu de usuários está visível
    }

    /**
     * Teste para verificar se o Gate antes funciona para sysadmin.
     */
    public function test_sysadmin_can_access_any_permission(): void
    {
        // Criar usuário com papel sysadmin
        $user = User::factory()->create();
        $user->assignRole('sysadmin');

        // Verificar se o sysadmin tem acesso mesmo a uma permissão que não foi explicitamente atribuída
        $this->assertTrue($user->can('qualquer.permissao'));
    }

    /**
     * Teste para verificar se usuários normais não têm permissões não atribuídas.
     */
    public function test_regular_user_cannot_access_unassigned_permissions(): void
    {
        // Criar usuário com papel admin
        $user = User::factory()->create();
        $user->assignRole('admin');

        // Verificar se o admin não tem acesso a uma permissão não atribuída
        $this->assertFalse($user->can('user.delete'));
    }
}
