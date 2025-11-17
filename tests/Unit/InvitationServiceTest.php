<?php

namespace Tests\Unit;

use App\Models\Invitation;
use App\Models\User;
use App\Services\InvitationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Mail\InvitationMail;

class InvitationServiceTest extends TestCase
{
    use RefreshDatabase;

    private InvitationService $invitationService;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Cria o serviço
        $this->invitationService = app(InvitationService::class);

        // Cria um usuário
        $this->user = User::factory()->create();
    }

    /**
     * Testa o método markAsAccepted() do serviço.
     */
    public function test_mark_as_accepted_method(): void
    {
        // Cria um convite válido
        $invitation = Invitation::factory()->create([
            'status' => Invitation::STATUS_PENDING,
            'expires_at' => Carbon::tomorrow(),
        ]);

        // Marca o convite como aceito
        $updatedInvitation = $this->invitationService->markAsAccepted($invitation, $this->user->id);

        // Verifica se o convite foi atualizado
        $this->assertEquals(Invitation::STATUS_ACCEPTED, $updatedInvitation->status);
        $this->assertNotNull($updatedInvitation->accepted_at);
        $this->assertEquals($this->user->id, $updatedInvitation->accepted_by);
    }

    /**
     * Testa o método markAsAccepted() com convite inválido.
     */
    public function test_mark_as_accepted_throws_exception_for_invalid_invitation(): void
    {
        // Cria um convite expirado
        $invitation = Invitation::factory()->create([
            'status' => Invitation::STATUS_PENDING,
            'expires_at' => Carbon::yesterday(),
        ]);

        $this->expectException(\InvalidArgumentException::class);

        // Tenta marcar o convite como aceito
        $this->invitationService->markAsAccepted($invitation, $this->user->id);
    }

    /**
     * Testa o envio de email ao criar um convite.
     */
    public function test_create_method_sends_email(): void
    {
        Mail::fake();

        // Cria um convite
        $email = 'newuser@example.com';
        $invitation = $this->invitationService->create(
            $this->user->id,
            7,
            null,
            $email
        );

        // Verifica se o convite foi criado corretamente
        $this->assertEquals($email, $invitation->email);
        $this->assertEquals(Invitation::STATUS_PENDING, $invitation->status);

        // Verifica se o email foi enviado
        Mail::assertSent(InvitationMail::class, function ($mail) use ($email) {
            return $mail->hasTo($email);
        });
    }

    /**
     * Testa a personalização da expiração ao criar um convite.
     */
    public function test_create_method_sets_expiration_days(): void
    {
        // Define quantos dias de expiração
        $expirationDays = 14;
        $expectedDate = now()->addDays($expirationDays)->startOfDay();

        // Cria um convite
        $invitation = $this->invitationService->create(
            $this->user->id,
            $expirationDays,
            null,
            'newuser@example.com'
        );

        // Verifica se a data de expiração está correta
        $this->assertEquals(
            $expectedDate->format('Y-m-d'),
            $invitation->expires_at->format('Y-m-d')
        );
    }
}
