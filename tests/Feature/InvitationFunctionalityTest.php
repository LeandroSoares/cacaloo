<?php

namespace Tests\Feature;

use App\Models\Invitation;
use App\Models\User;
use App\Services\InvitationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use App\Mail\InvitationMail;

class InvitationFunctionalityTest extends TestCase
{
    use RefreshDatabase;

    /** @var \App\Models\User */
    private User $admin;

    /** @var \App\Services\InvitationService */
    private InvitationService $invitationService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        // Criando roles necessárias
        $adminRole = Role::create(['name' => 'admin']);
        $sysadminRole = Role::create(['name' => 'sysadmin']);

        // Criando um usuário com papel de admin
        $this->admin = User::factory()->create();
        $this->admin->assignRole($adminRole);

        // Criando serviço de convites
        $this->invitationService = app(InvitationService::class);
    }

    /**
     * Testa a criação de um convite.
     */
    public function test_admin_can_create_invitation(): void
    {
        Mail::fake();

        $this->actingAs($this->admin);

        $response = $this->post(route('admin.invitations.store'), [
            'email' => 'test@example.com',
            'expires_days' => 10,
        ]);

        $response->assertRedirect(route('admin.invitations.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('invitations', [
            'email' => 'test@example.com',
            'status' => Invitation::STATUS_PENDING,
        ]);

        Mail::assertSent(InvitationMail::class);
    }

    /**
     * Testa o reenvio de um convite.
     */
    public function test_admin_can_resend_invitation(): void
    {
        Mail::fake();

        $this->actingAs($this->admin);

        // Cria um convite
        $invitation = $this->invitationService->create(
            'resend@example.com',
            $this->admin->id,
            7
        );

        // Limpa os e-mails enviados até aqui
        Mail::assertSent(InvitationMail::class);
        Mail::fake();

        // Tenta reenviar o convite
        $response = $this->post(route('admin.invitations.resend', $invitation));

        $response->assertRedirect(route('admin.invitations.index'));
        $response->assertSessionHas('success');

        // Verifica se um novo e-mail foi enviado
        Mail::assertSent(InvitationMail::class);
    }

    /**
     * Testa o cancelamento de um convite.
     */
    public function test_admin_can_cancel_invitation(): void
    {
        $this->actingAs($this->admin);

        // Cria um convite
        $invitation = $this->invitationService->create(
            'cancel@example.com',
            $this->admin->id,
            7
        );

        // Cancela o convite
        $response = $this->patch(route('admin.invitations.cancel', $invitation));

        $response->assertRedirect(route('admin.invitations.index'));
        $response->assertSessionHas('success');

        // Verifica se o convite foi cancelado
        $this->assertDatabaseHas('invitations', [
            'id' => $invitation->id,
            'status' => Invitation::STATUS_CANCELLED,
        ]);
    }

    /**
     * Testa a validação do e-mail ao criar convite.
     */
    public function test_invitation_email_validation(): void
    {
        $this->actingAs($this->admin);

        // Cria um convite
        $this->invitationService->create(
            'existing@example.com',
            $this->admin->id,
            7
        );

        // Tenta criar um convite com o mesmo e-mail
        $this->withoutExceptionHandling();

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->post(route('admin.invitations.store'), [
            'email' => 'existing@example.com',
        ]);
    }
}
