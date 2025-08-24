<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Models\Invitation;
use App\Services\InvitationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
     * Armazena um novo convite
     */
    public function store(InvitationRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $expirationDays = $validated['expires_days'] ?? 7;

        try {
            $invitation = $this->invitationService->create(
                $validated['email'],
                Auth::id(),
                $expirationDays
            );

            return redirect()->route('admin.invitations.index')
                ->with('success', 'Convite enviado com sucesso para ' . $invitation->email);
        } catch (\Exception $e) {
            return redirect()->route('admin.invitations.index')
                ->with('error', 'Erro ao enviar convite: ' . $e->getMessage());
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
                ->with('success', 'Convite reenviado com sucesso para ' . $invitation->email);
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('admin.invitations.index')
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('admin.invitations.index')
                ->with('error', 'Erro ao reenviar convite: ' . $e->getMessage());
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
                ->with('error', 'Erro ao cancelar convite: ' . $e->getMessage());
        }
    }
}
