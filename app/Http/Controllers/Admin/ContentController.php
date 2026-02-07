<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ContentType;
use App\Enums\ContentVisibility;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Validation\GenericRule;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = Content::orderByDesc('created_at')->paginate(10);
        return view('admin.contents.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contents.create', [
            'types' => ContentType::cases(),
            'visibilities' => ContentVisibility::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:contents,slug',
            'body' => 'required|string',
            'type' => ['required', new \Illuminate\Validation\Rules\Enum(ContentType::class)],
            'visibility' => ['required', new \Illuminate\Validation\Rules\Enum(ContentVisibility::class)],
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        Content::create($validated);

        return redirect()->route('admin.contents.index')
            ->with('success', 'Conteúdo criado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        return view('admin.contents.edit', [
            'content' => $content,
            'types' => ContentType::cases(),
            'visibilities' => ContentVisibility::cases(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:contents,slug,' . $content->id,
            'body' => 'required|string',
            'type' => ['required', new \Illuminate\Validation\Rules\Enum(ContentType::class)],
            'visibility' => ['required', new \Illuminate\Validation\Rules\Enum(ContentVisibility::class)],
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        // Tratar checkbox is_active se não vier (bizarro no HTML)
        // Mas usando form bind do Laravel ou input hidden resolve.
        // Aqui assumo que o request trará os dados corretos.

        $content->update($validated);

        return redirect()->route('admin.contents.index')
            ->with('success', 'Conteúdo atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        $content->delete();

        return redirect()->route('admin.contents.index')
            ->with('success', 'Conteúdo excluído com sucesso.');
    }
}
