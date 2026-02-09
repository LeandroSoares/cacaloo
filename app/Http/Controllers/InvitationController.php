<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Models\Invitation;
use App\Services\InvitationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class InvitationController extends Controller
{
    /**
     * @var InvitationService
     */
    protected $invitationService;

    /**
     * Construtor com injeção de dependência
     */
    public function __construct(InvitationService $invitationService)
    {
        $this->invitationService = $invitationService;
    }

    /**
     * Mostra a lista de convites
     */
    public function index(): View
    {
        $invitations = Invitation::with('inviter')->latest()->get();

        return view('admin.invitations.index', compact('invitations'));
    }

    /**
     * Mostra o formulário para criar um novo convite
     */
    public function create(): View
    {
        return view('admin.invitations.create');
    }

    /**
     * Mostra detalhes de um convite específico
     */
    public function show(Invitation $invitation): View
    {
        $invitation->load('inviter', 'acceptedBy');

        return view('admin.invitations.show', compact('invitation'));
    }

    /**
     * Armazena um novo convite
     */
    public function store(InvitationRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $expirationDays = $validated['expires_days'] ?? 7;

        try {
            $invitation = $this->invitationService->create(
                Auth::id(),
                $expirationDays,
                $validated['name'] ?? null,
                $validated['email'] ?? null,
                $validated['whatsapp'] ?? null
            );

            // Mensagem dinâmica baseada no tipo de convite
            $message = 'Convite criado com sucesso';
            if ($invitation->name) {
                $message .= ' para '.$invitation->name;
            } elseif ($invitation->email) {
                $message .= ' e enviado para '.$invitation->email;
            } elseif ($invitation->whatsapp) {
                $message .= ' para '.$invitation->whatsapp;
            } else {
                $message = 'Convite anônimo criado com sucesso';
            }

            return redirect()->route('admin.invitations.index')
                ->with('success', $message.'.');
        } catch (\Exception $e) {
            return redirect()->route('admin.invitations.index')
                ->with('error', 'Erro ao criar convite: '.$e->getMessage());
        }
    }

    /**
     * Remove um convite
     */
    public function destroy(Invitation $invitation): RedirectResponse
    {
        $invitation->delete();

        return redirect()->route('admin.invitations.index')
            ->with('success', 'Convite excluído com sucesso.');
    }

    /**
     * Reenvia um convite
     */
    public function resend(Invitation $invitation): RedirectResponse
    {
        try {
            $this->invitationService->resend($invitation);

            return redirect()->route('admin.invitations.index')
                ->with('success', 'Convite reenviado com sucesso para '.$invitation->email);
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('admin.invitations.index')
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('admin.invitations.index')
                ->with('error', 'Erro ao reenviar convite: '.$e->getMessage());
        }
    }

    /**
     * Cancela um convite
     */
    public function cancel(Invitation $invitation): RedirectResponse
    {
        try {
            $this->invitationService->cancel($invitation);

            return redirect()->route('admin.invitations.index')
                ->with('success', 'Convite cancelado com sucesso.');
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('admin.invitations.index')
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('admin.invitations.index')
                ->with('error', 'Erro ao cancelar convite: '.$e->getMessage());
        }
    }
}
