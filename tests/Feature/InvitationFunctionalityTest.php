<?php

namespace Tests\Feature;

use App\Mail\InvitationMail;
use App\Models\Invitation;
use App\Models\User;
use App\Services\InvitationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class InvitationFunctionalityTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

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
     * Testa a criação de um convite com email.
     */
    public function test_admin_can_create_invitation(): void
    {
        Mail::fake();

        $this->actingAs($this->admin);

        $invitationData = [
            'name' => 'João da Silva',
            'email' => 'novo.usuario@example.com',
            'expires_days' => 7,
        ];

        $response = $this->post(route('admin.invitations.store'), $invitationData);

        $response->assertRedirect();
        $this->assertDatabaseHas('invitations', [
            'name' => 'João da Silva',
            'email' => 'novo.usuario@example.com',
            'invited_by' => $this->admin->id,
            'status' => Invitation::STATUS_PENDING,
        ]);

        Mail::assertSent(InvitationMail::class, function ($mail) use ($invitationData) {
            return $mail->hasTo($invitationData['email']);
        });
    }

    /**
     * Testa a criação de um convite anônimo (sem email/whatsapp).
     */
    public function test_admin_can_create_anonymous_invitation(): void
    {
        Mail::fake();

        $this->actingAs($this->admin);

        $invitationData = [
            'expires_days' => 7,
        ];

        $response = $this->post(route('admin.invitations.store'), $invitationData);

        $response->assertRedirect();
        $this->assertDatabaseHas('invitations', [
            'email' => null,
            'whatsapp' => null,
            'invited_by' => $this->admin->id,
            'status' => Invitation::STATUS_PENDING,
        ]);

        // Não deve enviar email para convite anônimo
        Mail::assertNothingSent();
    }

    /**
     * Testa se usuário registrado via convite recebe automaticamente a role "user"
     */
    public function test_invited_user_receives_user_role_automatically(): void
    {
        // Criar role user
        Role::create(['name' => 'user']);

        // Criar convite
        $invitation = $this->invitationService->create(
            $this->admin->id,
            7,
            null,
            'newuser@example.com'
        );

        // Dados de registro
        $registrationData = [
            'name' => 'Novo Usuário',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'token' => $invitation->token,
        ];

        // Registrar usuário via convite
        $this->post(route('register'), $registrationData);

        // Verificar se usuário foi criado
        $user = User::where('email', 'newuser@example.com')->first();
        $this->assertNotNull($user);

        // Verificar se recebeu a role "user" automaticamente
        $this->assertTrue($user->hasRole('user'));

        // Verificar se convite foi marcado como aceito
        $invitation->refresh();
        $this->assertTrue($invitation->isAccepted());
        $this->assertEquals($user->id, $invitation->accepted_by);
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
            $this->admin->id,
            7,
            null,
            'resend@example.com'
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
            $this->admin->id,
            7,
            null,
            'cancel@example.com'
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
            $this->admin->id,
            7,
            null,
            'existing@example.com'
        );

        // Tenta criar um convite com o mesmo e-mail
        $this->withoutExceptionHandling();

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->post(route('admin.invitations.store'), [
            'email' => 'existing@example.com',
        ]);
    }

    /**
     * Testa a visualização de detalhes de um convite.
     */
    public function test_admin_can_view_invitation_details(): void
    {
        $this->actingAs($this->admin);

        // Cria um convite
        $invitation = $this->invitationService->create(
            $this->admin->id,
            7,
            'João Silva',
            'joao@example.com',
            '(11) 99999-9999'
        );

        // Acessa a página de visualização
        $response = $this->get(route('admin.invitations.show', $invitation));

        $response->assertStatus(200);
        $response->assertSee('João Silva');
        $response->assertSee('joao@example.com');
        $response->assertSee('(11) 99999-9999');
        $response->assertSee($this->admin->name);
        $response->assertSee('Compartilhar via WhatsApp');
    }
}
