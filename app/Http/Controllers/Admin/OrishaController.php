<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrishaRequest;
use App\Models\Orisha;
use Illuminate\Http\Request;

class OrishaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Orisha::query();

        // Pesquisa por nome
        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // Filtro por status ativo/inativo
        if ($request->filled('active')) {
            $query->where('active', $request->boolean('active'));
        }

        // Filtro por lado (direita/esquerda)
        if ($request->filled('side')) {
            if ($request->side === 'right') {
                $query->where('is_right', true);
            } elseif ($request->side === 'left') {
                $query->where('is_left', true);
            }
        }

        $orishas = $query->orderBy('name')->paginate(15);

        return view('admin.orishas.index', compact('orishas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.orishas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrishaRequest $request)
    {
        Orisha::create($request->validated());

        return redirect()->route('admin.orishas.index')
            ->with('success', 'Orixá criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Orisha $orisha)
    {
        $orisha->load(['initiatedOrishas.user']);

        return view('admin.orishas.show', compact('orisha'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orisha $orisha)
    {
        return view('admin.orishas.edit', compact('orisha'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrishaRequest $request, Orisha $orisha)
    {
        $orisha->update($request->validated());

        return redirect()->route('admin.orishas.index')
            ->with('success', 'Orixá atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orisha $orisha)
    {
        // Verificar se o orixá tem usuários associados
        $hasUsers = $orisha->initiatedOrishas()->count() > 0;

        if ($hasUsers) {
            return redirect()->route('admin.orishas.index')
                ->with('error', 'Não é possível excluir um orixá que possui usuários associados.');
        }

        $orisha->delete();

        return redirect()->route('admin.orishas.index')
            ->with('success', 'Orixá excluído com sucesso!');
    }
}
