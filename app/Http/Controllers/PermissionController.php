<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Mostra a lista de permissões
     */
    public function index(): View
    {
        $permissions = Permission::with('roles')->get();

        return view('sysadmin.permissions.index', compact('permissions'));
    }

    /**
     * Mostra o formulário para criar uma nova permissão
     */
    public function create(): View
    {
        return view('sysadmin.permissions.create');
    }

    /**
     * Armazena uma nova permissão no banco de dados
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permissão criada com sucesso.');
    }

    /**
     * Mostra o formulário para editar uma permissão
     */
    public function edit(Permission $permission): View
    {
        return view('sysadmin.permissions.edit', compact('permission'));
    }

    /**
     * Atualiza uma permissão no banco de dados
     */
    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permissão atualizada com sucesso.');
    }

    /**
     * Remove uma permissão do banco de dados
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        // Verificar se a permissão pode ser excluída (por exemplo, verificar se está em uso)
        if ($permission->roles()->count() > 0) {
            return redirect()->route('permissions.index')
                ->with('error', 'Não é possível excluir uma permissão que está atribuída a papéis.');
        }

        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permissão excluída com sucesso.');
    }
}
