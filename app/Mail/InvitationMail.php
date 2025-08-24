<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public readonly Invitation $invitation
    ) {}

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Convite para participar do sistema Cacaloo')
            ->view('emails.invitation', [
                'invitation' => $this->invitation
            ]);
    }
}
