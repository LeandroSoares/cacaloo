<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MagicTypeRequest;
use App\Models\MagicType;
use Illuminate\Http\Request;

class MagicTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MagicType::query();

        // Pesquisa por nome
        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // Filtro por status ativo/inativo
        if ($request->filled('active')) {
            $query->where('active', $request->boolean('active'));
        }

        $magicTypes = $query->orderBy('name')->paginate(15);

        return view('admin.magic-types.index', compact('magicTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.magic-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MagicTypeRequest $request)
    {
        MagicType::create($request->validated());

        return redirect()->route('admin.magic-types.index')
            ->with('success', 'Tipo de magia criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MagicType $magicType)
    {
        $magicType->load('divineMagics.user');

        return view('admin.magic-types.show', compact('magicType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MagicType $magicType)
    {
        return view('admin.magic-types.edit', compact('magicType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MagicTypeRequest $request, MagicType $magicType)
    {
        $magicType->update($request->validated());

        return redirect()->route('admin.magic-types.index')
            ->with('success', 'Tipo de magia atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MagicType $magicType)
    {
        // Verificar se o tipo de magia tem usuários associados
        if ($magicType->divineMagics()->count() > 0) {
            return redirect()->route('admin.magic-types.index')
                ->with('error', 'Não é possível excluir um tipo de magia que possui usuários associados.');
        }

        $magicType->delete();

        return redirect()->route('admin.magic-types.index')
            ->with('success', 'Tipo de magia excluído com sucesso!');
    }
}
