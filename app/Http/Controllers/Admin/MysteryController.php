<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MysteryRequest;
use App\Models\Mystery;
use Illuminate\Http\Request;

class MysteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mystery::query();

        // Pesquisa por nome
        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // Filtro por status ativo/inativo
        if ($request->filled('active')) {
            $query->where('active', $request->boolean('active'));
        }

        $mysteries = $query->orderBy('name')->paginate(15);

        return view('admin.mysteries.index', compact('mysteries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mysteries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MysteryRequest $request)
    {
        Mystery::create($request->validated());

        return redirect()->route('admin.mysteries.index')
            ->with('success', 'Mistério criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mystery $mystery)
    {
        $mystery->load('initiatedMysteries.user');

        return view('admin.mysteries.show', compact('mystery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mystery $mystery)
    {
        return view('admin.mysteries.edit', compact('mystery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MysteryRequest $request, Mystery $mystery)
    {
        $mystery->update($request->validated());

        return redirect()->route('admin.mysteries.index')
            ->with('success', 'Mistério atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mystery $mystery)
    {
        // Verificar se o mistério tem usuários associados
        if ($mystery->initiatedMysteries()->count() > 0) {
            return redirect()->route('admin.mysteries.index')
                ->with('error', 'Não é possível excluir um mistério que possui usuários associados.');
        }

        $mystery->delete();

        return redirect()->route('admin.mysteries.index')
            ->with('success', 'Mistério excluído com sucesso!');
    }
}
