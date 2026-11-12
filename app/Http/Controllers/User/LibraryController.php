<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LibraryFile;
use App\Models\LibraryTag;
use App\Services\LibraryFileService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LibraryController extends Controller
{
    public function __construct(
        private readonly LibraryFileService $libraryService
    ) {}

    public function index(Request $request)
    {
        $tags = LibraryTag::query()
            ->whereHas('files', fn ($query) => $query->active())
            ->ordered()
            ->get();

        $files = LibraryFile::query()
            ->active()
            ->with('tags')
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = trim((string) $request->input('search'));
                $query->where(function ($sub) use ($term) {
                    $sub->where('title', 'like', "%{$term}%")
                        ->orWhere('description', 'like', "%{$term}%")
                        ->orWhereHas('tags', fn ($tagQuery) => $tagQuery->where('name', 'like', "%{$term}%"));
                });
            })
            ->when($request->filled('tag'), function ($query) use ($request) {
                $tagSlug = (string) $request->input('tag');
                $query->whereHas('tags', fn ($tagQuery) => $tagQuery->where('slug', $tagSlug));
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('user.library.index', compact('files', 'tags'));
    }

    public function download(LibraryFile $libraryFile): StreamedResponse
    {
        abort_unless($libraryFile->is_active, 404);

        return $this->libraryService->streamDownload($libraryFile);
    }

    public function cover(LibraryFile $libraryFile): StreamedResponse
    {
        abort_unless($libraryFile->is_active, 404);

        return $this->libraryService->streamCover($libraryFile);
    }
}
