<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View|RedirectResponse
    {
        // Verifica se existe um token válido
        $token = $request->query('token');

        if (!$token) {
            return redirect()->route('login')
                ->with('error', 'Você precisa de um convite válido para se registrar.');
        }

        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation || !$invitation->isValid()) {
            return redirect()->route('login')
                ->with('error', 'O convite é inválido ou expirou.');
        }

        // Passa o token e o email para a view
        return view('auth.register', [
            'token' => $token,
            'email' => $invitation->email
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'token' => ['required', 'string'],
        ]);

        // Verifica se o token é válido
        $invitation = Invitation::where('token', $request->token)
            ->where('email', $request->email)
            ->first();

        if (!$invitation || !$invitation->isValid()) {
            return back()->withErrors([
                'token' => 'O convite é inválido ou expirou.',
            ])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Marca o convite como aceito e registra quem aceitou
        $invitation->markAsAccepted($user->id);

        event(new Registered($user));

        Auth::login($user);        return redirect(route('dashboard', absolute: false));
    }
}
