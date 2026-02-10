<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkGuideCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkGuideCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = WorkGuideCategory::query()->orderBy('display_order');

        // Busca por nome ou slug
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        // Filtro por status ativo/inativo
        if ($request->filled('status')) {
            $query->where('is_active', $request->get('status') === 'active');
        }

        $categories = $query->paginate(15);

        return view('admin.work-guide-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.work-guide-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:work_guide_categories,slug',
            'icon' => 'nullable|string|max:50',
            'display_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Gerar slug automaticamente se não fornecido
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Garantir que is_active está presente
        $validated['is_active'] = $request->has('is_active');

        WorkGuideCategory::create($validated);

        return redirect()->route('admin.work-guide-categories.index')
            ->with('success', 'Categoria criada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkGuideCategory $workGuideCategory)
    {
        return view('admin.work-guide-categories.edit', [
            'category' => $workGuideCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkGuideCategory $workGuideCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:work_guide_categories,slug,' . $workGuideCategory->id,
            'icon' => 'nullable|string|max:50',
            'display_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Garantir que is_active está presente
        $validated['is_active'] = $request->has('is_active');

        $workGuideCategory->update($validated);

        return redirect()->route('admin.work-guide-categories.index')
            ->with('success', 'Categoria atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkGuideCategory $workGuideCategory)
    {
        $workGuideCategory->delete();

        return redirect()->route('admin.work-guide-categories.index')
            ->with('success', 'Categoria excluída com sucesso.');
    }
}
