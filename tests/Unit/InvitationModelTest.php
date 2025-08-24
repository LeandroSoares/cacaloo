<?php

namespace Tests\Unit;

use App\Models\Invitation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa o método isValid() quando o convite está pendente e não expirado.
     */
    public function test_is_valid_returns_true_for_pending_non_expired_invitation(): void
    {
        // Cria um convite pendente que expira amanhã
        $invitation = Invitation::factory()->create([
            'status' => Invitation::STATUS_PENDING,
            'expires_at' => Carbon::tomorrow(),
        ]);

        $this->assertTrue($invitation->isValid());
    }

    /**
     * Testa o método isValid() quando o convite está expirado.
     */
    public function test_is_valid_returns_false_for_expired_invitation(): void
    {
        // Cria um convite pendente que expirou ontem
        $invitation = Invitation::factory()->create([
            'status' => Invitation::STATUS_PENDING,
            'expires_at' => Carbon::yesterday(),
        ]);

        $this->assertFalse($invitation->isValid());
        $this->assertTrue($invitation->isExpired());
    }

    /**
     * Testa o método isValid() quando o convite está cancelado.
     */
    public function test_is_valid_returns_false_for_cancelled_invitation(): void
    {
        // Cria um convite cancelado
        $invitation = Invitation::factory()->create([
            'status' => Invitation::STATUS_CANCELLED,
            'expires_at' => Carbon::tomorrow(), // Mesmo não expirado
        ]);

        $this->assertFalse($invitation->isValid());
        $this->assertTrue($invitation->isCancelled());
    }

    /**
     * Testa o método isValid() quando o convite já foi aceito.
     */
    public function test_is_valid_returns_false_for_accepted_invitation(): void
    {
        // Cria um convite aceito
        $invitation = Invitation::factory()->create([
            'status' => Invitation::STATUS_ACCEPTED,
            'expires_at' => Carbon::tomorrow(), // Mesmo não expirado
            'accepted_at' => Carbon::now(),
        ]);

        $this->assertFalse($invitation->isValid());
        $this->assertTrue($invitation->isAccepted());
    }

    /**
     * Testa o método markAsAccepted().
     */
    public function test_mark_as_accepted_updates_invitation(): void
    {
        // Cria um convite pendente
        $invitation = Invitation::factory()->create([
            'status' => Invitation::STATUS_PENDING,
            'expires_at' => Carbon::tomorrow(),
        ]);

        // Cria um usuário
        $user = User::factory()->create();

        // Marca o convite como aceito
        $invitation->markAsAccepted($user->id);

        // Verifica se o convite foi atualizado
        $this->assertEquals(Invitation::STATUS_ACCEPTED, $invitation->status);
        $this->assertNotNull($invitation->accepted_at);
        $this->assertEquals($user->id, $invitation->accepted_by);
    }

    /**
     * Testa o método markAsCancelled().
     */
    public function test_mark_as_cancelled_updates_invitation(): void
    {
        // Cria um convite pendente
        $invitation = Invitation::factory()->create([
            'status' => Invitation::STATUS_PENDING,
            'expires_at' => Carbon::tomorrow(),
        ]);

        // Marca o convite como cancelado
        $invitation->markAsCancelled();

        // Verifica se o convite foi atualizado
        $this->assertEquals(Invitation::STATUS_CANCELLED, $invitation->status);
    }

    /**
     * Testa a geração de token.
     */
    public function test_generate_token_creates_unique_token(): void
    {
        $token1 = Invitation::generateToken();
        $token2 = Invitation::generateToken();

        $this->assertNotEquals($token1, $token2);
        $this->assertEquals(64, strlen($token1));
    }
}
