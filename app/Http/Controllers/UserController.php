<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Mostra a lista de usuários
     */
    public function index(): View
    {
        // Mostrar usuários inativos apenas para sysadmin
        if (Auth::check() && Auth::user()->hasRole('sysadmin')) {
            $users = User::getAllIncludingInactive()->load('roles');
        } else {
            $users = User::with('roles')->get();
        }
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Mostra o formulário para criar um novo usuário
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Armazena um novo usuário no banco de dados
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->roles);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário criado com sucesso.');
    }

    /**
     * Mostra o formulário para editar um usuário
     */
    public function edit(User $user): View
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Atualiza um usuário no banco de dados
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'required|array',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);
        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário atualizado com sucesso.');
    }

    /**
     * Remove um usuário do banco de dados
     */
    public function destroy(User $user): RedirectResponse
    {
        // Verificar se o usuário é o sysadmin inicial (não pode ser excluído)
        if ($user->email === 'admin@cacaloo.com.br') {
            return redirect()->route('admin.users.index')
                ->with('error', 'O usuário administrador do sistema não pode ser excluído.');
        }

        // Verificar se o usuário atual é sysadmin
        if (Auth::check() && Auth::user()->hasRole('sysadmin')) {
            // Exclusão permanente (apenas sysadmin)
            $user->delete();
            return redirect()->route('admin.users.index')
                ->with('success', 'Usuário excluído permanentemente do banco de dados.');
        } else {
            // Desativação (outros admins)
            $user->deactivate();
            return redirect()->route('admin.users.index')
                ->with('success', 'Usuário desativado com sucesso.');
        }
    }
}
