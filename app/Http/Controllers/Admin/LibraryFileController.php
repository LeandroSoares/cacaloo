<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LibraryFileRequest;
use App\Models\LibraryFile;
use App\Models\LibraryTag;
use App\Services\LibraryFileService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LibraryFileController extends Controller
{
    public function __construct(
        private readonly LibraryFileService $libraryService
    ) {}

    public function index(Request $request)
    {
        $tags = LibraryTag::ordered()->withCount('files')->get();

        $files = LibraryFile::query()
            ->with(['tags', 'uploader'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = trim((string) $request->input('search'));
                $query->where(function ($sub) use ($term) {
                    $sub->where('title', 'like', "%{$term}%")
                        ->orWhere('description', 'like', "%{$term}%")
                        ->orWhere('original_name', 'like', "%{$term}%")
                        ->orWhereHas('tags', fn ($tagQuery) => $tagQuery->where('name', 'like', "%{$term}%"));
                });
            })
            ->when($request->filled('tag'), function ($query) use ($request) {
                $tagSlug = (string) $request->input('tag');
                $query->whereHas('tags', fn ($tagQuery) => $tagQuery->where('slug', $tagSlug));
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                if ($request->input('status') === 'active') {
                    $query->where('is_active', true);
                } elseif ($request->input('status') === 'inactive') {
                    $query->where('is_active', false);
                }
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.library.index', compact('files', 'tags'));
    }

    public function create()
    {
        $tags = LibraryTag::ordered()->get();

        return view('admin.library.create', compact('tags'));
    }

    public function store(LibraryFileRequest $request)
    {
        $this->libraryService->create(
            $request->validated(),
            $request->file('file'),
            $request->file('cover'),
            $request->user()
        );

        return redirect()
            ->route('admin.library.index')
            ->with('success', 'Arquivo adicionado à biblioteca com sucesso!');
    }

    public function show(LibraryFile $library)
    {
        $library->load(['tags', 'uploader']);

        return view('admin.library.show', ['file' => $library]);
    }

    public function edit(LibraryFile $library)
    {
        $library->load('tags');
        $tags = LibraryTag::ordered()->get();

        return view('admin.library.edit', [
            'file' => $library,
            'tags' => $tags,
        ]);
    }

    public function update(LibraryFileRequest $request, LibraryFile $library)
    {
        $this->libraryService->update(
            $library,
            $request->validated(),
            $request->file('file'),
            $request->file('cover')
        );

        return redirect()
            ->route('admin.library.index')
            ->with('success', 'Arquivo atualizado com sucesso!');
    }

    public function destroy(LibraryFile $library)
    {
        $this->libraryService->delete($library);

        return redirect()
            ->route('admin.library.index')
            ->with('success', 'Arquivo excluído da biblioteca com sucesso!');
    }

    public function toggleActive(LibraryFile $library)
    {
        $library->update([
            'is_active' => ! $library->is_active,
        ]);

        $statusLabel = $library->is_active ? 'ativado' : 'desativado';

        return back()->with('success', "Arquivo {$statusLabel} com sucesso!");
    }

    public function download(LibraryFile $library): StreamedResponse
    {
        return $this->libraryService->streamDownload($library);
    }

    public function cover(LibraryFile $library): StreamedResponse
    {
        return $this->libraryService->streamCover($library);
    }

    public function destroyTag(Request $request, LibraryTag $libraryTag)
    {
        $tagName = $libraryTag->name;
        $libraryTag->files()->detach();
        $libraryTag->delete();

        $message = "Tag \"{$tagName}\" removida com sucesso!";

        if ($request->expectsJson()) {
            return response()->json([
                'deleted' => true,
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
    }
}
