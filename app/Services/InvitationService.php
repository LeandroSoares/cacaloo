<?php

namespace App\Services;

use App\Models\Invitation;
use App\Mail\InvitationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class InvitationService
{
    /**
     * Cria um novo convite para o email especificado
     */
    public function create(string $email, int $invitedBy, int $expirationDays = 7): Invitation
    {
        $invitation = Invitation::create([
            'email' => $email,
            'token' => Invitation::generateToken(),
            'invited_by' => $invitedBy,
            'status' => Invitation::STATUS_PENDING,
            'expires_at' => now()->addDays($expirationDays),
        ]);

        $this->sendInvitationEmail($invitation);

        return $invitation;
    }

    /**
     * Reenvia um convite existente
     */
    public function resend(Invitation $invitation, int $expirationDays = 7): Invitation
    {
        if ($invitation->isAccepted() || $invitation->isCancelled()) {
            throw new \InvalidArgumentException('Este convite não pode ser reenviado.');
        }

        $invitation->update([
            'token' => Invitation::generateToken(),
            'status' => Invitation::STATUS_PENDING,
            'expires_at' => now()->addDays($expirationDays),
        ]);

        $this->sendInvitationEmail($invitation);

        return $invitation;
    }

    /**
     * Cancela um convite existente
     */
    public function cancel(Invitation $invitation): Invitation
    {
        if ($invitation->isAccepted()) {
            throw new \InvalidArgumentException('Não é possível cancelar um convite já aceito.');
        }

        $invitation->markAsCancelled();

        return $invitation;
    }

    /**
     * Marca um convite como aceito
     */
    public function markAsAccepted(Invitation $invitation, ?int $userId = null): Invitation
    {
        if (!$invitation->isValid()) {
            throw new \InvalidArgumentException('Este convite não é válido para aceitação.');
        }

        $invitation->markAsAccepted($userId);

        return $invitation;
    }

    /**
     * Envia o email de convite
     */
    protected function sendInvitationEmail(Invitation $invitation): void
    {
        // Carrega explicitamente a relação de quem convidou
        $invitation->load('inviter');

        Mail::to($invitation->email)->send(new InvitationMail($invitation));
    }
}
