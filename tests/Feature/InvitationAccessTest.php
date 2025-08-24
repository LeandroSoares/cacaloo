<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class InvitationAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste de acesso à área de convites para administrador.
     */
    public function test_admin_can_access_invitations_area(): void
    {
        $this->withoutExceptionHandling();
        $this->withoutDeprecationHandling();

        // Criando roles necessárias usando o método create direto
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'sysadmin']);

        // Criando um usuário com papel de admin
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Realizando login como admin
        $this->actingAs($admin);

        // Testando acesso à listagem de convites
        $response = $this->get(route('admin.invitations.index'));

        $response->assertStatus(200);
    }

    /**
     * Teste de acesso à área de convites para sysadmin.
     */
    public function test_sysadmin_can_access_invitations_area(): void
    {
        // Verificando se a role sysadmin existe
        if (!Role::where('name', 'sysadmin')->exists()) {
            Role::create(['name' => 'sysadmin']);
        }

        // Criando um usuário com papel de sysadmin
        /** @var \App\Models\User $sysadmin */
        $sysadmin = User::factory()->create();
        $sysadmin->assignRole('sysadmin');

        // Realizando login como sysadmin
        $this->actingAs($sysadmin);

        // Testando acesso à listagem de convites
        $response = $this->get(route('admin.invitations.index'));

        $response->assertStatus(200);
    }

    /**
     * Teste de restrição de acesso para usuários comuns.
     */
    public function test_regular_user_cannot_access_invitations_area(): void
    {
        // Criando um usuário comum
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // Realizando login como usuário comum
        $this->actingAs($user);

        // Testando restrição de acesso à listagem de convites
        $response = $this->get(route('admin.invitations.index'));

        $response->assertStatus(302); // Redirecionamento
        $response->assertRedirect(route('dashboard')); // Verifica se redirecionou para dashboard
    }
}
