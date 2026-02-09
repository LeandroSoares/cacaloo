<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Configurar permissões e papéis
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Criar permissões básicas para teste
        Permission::create(['name' => 'user.view']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.delete']);

        // Criar papéis
        $adminRole = Role::create(['name' => 'admin']);

        // Atribuir permissões aos papéis
        $adminRole->givePermissionTo(['user.view', 'user.create', 'user.edit', 'user.delete']);

        // Criar usuário admin para testes
        $this->admin = User::factory()->create([
            'email' => 'admin@test.com',
        ]);
        $this->admin->assignRole('admin');
    }

    /**
     * Teste para verificar se o admin pode listar usuários.
     */
    public function test_admin_can_view_users_list(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/users');

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.index');
    }

    /**
     * Teste para verificar se o admin pode acessar o formulário de criação de usuário.
     */
    public function test_admin_can_access_user_create_form(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/users/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.create');
    }

    /**
     * Teste para verificar se o admin pode criar um novo usuário.
     */
    public function test_admin_can_create_new_user(): void
    {
        // Buscar papéis disponíveis
        $role = Role::where('name', 'admin')->first();

        $response = $this->actingAs($this->admin)->post('/admin/users', [
            'name' => 'Novo Usuário',
            'email' => 'novo@exemplo.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'roles' => [$role->name],
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'name' => 'Novo Usuário',
            'email' => 'novo@exemplo.com',
        ]);

        // Verificar se o papel foi atribuído corretamente
        $newUser = User::where('email', 'novo@exemplo.com')->first();
        $this->assertTrue($newUser->hasRole('admin'));
    }

    /**
     * Teste para verificar se o admin pode editar um usuário existente.
     */
    public function test_admin_can_edit_existing_user(): void
    {
        // Criar um usuário para editar
        $user = User::factory()->create([
            'name' => 'Usuário Existente',
            'email' => 'existente@exemplo.com',
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/users/'.$user->id.'/edit');

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.edit');
        $response->assertSee('Usuário Existente');
    }

    /**
     * Teste para verificar se o admin pode atualizar um usuário existente.
     */
    public function test_admin_can_update_existing_user(): void
    {
        // Criar um usuário para atualizar
        $user = User::factory()->create([
            'name' => 'Usuário Original',
            'email' => 'original@exemplo.com',
        ]);

        // Buscar papéis disponíveis
        $role = Role::where('name', 'admin')->first();

        $response = $this->actingAs($this->admin)->put('/admin/users/'.$user->id, [
            'name' => 'Usuário Atualizado',
            'email' => 'original@exemplo.com',
            'roles' => [$role->name],
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Usuário Atualizado',
        ]);

        // Verificar se o papel foi atribuído corretamente
        $updatedUser = User::find($user->id);
        $this->assertTrue($updatedUser->hasRole('admin'));
    }

    /**
     * Teste para verificar se o admin pode excluir um usuário.
     */
    public function test_admin_can_delete_user(): void
    {
        // Criar um usuário para excluir
        $user = User::factory()->create([
            'name' => 'Usuário para Excluir',
            'email' => 'excluir@exemplo.com',
        ]);

        $response = $this->actingAs($this->admin)->delete('/admin/users/'.$user->id);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'is_active' => false,
        ]);
    }

    /**
     * Teste para verificar se não é possível excluir o usuário administrador do sistema.
     */
    public function test_cannot_delete_system_admin_user(): void
    {
        // Criar o usuário sysadmin
        $sysadminRole = Role::create(['name' => 'sysadmin']);
        $sysadmin = User::factory()->create([
            'name' => 'Administrador do Sistema',
            'email' => 'admin@cacaloo.com.br',
        ]);
        $sysadmin->assignRole('sysadmin');

        $response = $this->actingAs($this->admin)->delete('/admin/users/'.$sysadmin->id);

        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('error', 'O usuário administrador do sistema não pode ser excluído.');
        $this->assertDatabaseHas('users', [
            'email' => 'admin@cacaloo.com.br',
        ]);
    }
}
