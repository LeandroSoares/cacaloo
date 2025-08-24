<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    /**
     * Mostra a lista de papéis
     */
    public function index(): View
    {
        $roles = Role::with('permissions')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Mostra o formulário para criar um novo papel
     */
    public function create(): View
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Armazena um novo papel no banco de dados
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Papel criado com sucesso.');
    }

    /**
     * Mostra o formulário para editar um papel
     */
    public function edit(Role $role): View
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Atualiza um papel no banco de dados
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Papel atualizado com sucesso.');
    }

    /**
     * Remove um papel do banco de dados
     */
    public function destroy(Role $role): RedirectResponse
    {
        // Verificar se o papel pode ser excluído (por exemplo, não excluir sysadmin)
        if ($role->name === 'sysadmin') {
            return redirect()->route('roles.index')
                ->with('error', 'O papel de Administrador do Sistema não pode ser excluído.');
        }

        // Verificar se há usuários com este papel
        if ($role->users->count() > 0) {
            return redirect()->route('roles.index')
                ->with('error', 'Não é possível excluir um papel que está em uso por usuários.');
        }

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Papel excluído com sucesso.');
    }
}
