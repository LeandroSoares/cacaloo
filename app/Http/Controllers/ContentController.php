<?php

namespace App\Http\Controllers;

use App\Enums\ContentVisibility;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    /**
     * Exibe conteúdo público (acessível por qualquer um)
     * Rota: /{slug}
     */
    public function showPublic(string $slug)
    {
        $content = Content::published()
            ->where('slug', $slug)
            ->where('visibility', ContentVisibility::PUBLIC)
            ->firstOrFail();

        return view('contents.show', compact('content'));
    }

    /**
     * Exibe conteúdo privado (apenas logados)
     * Rota: /portal/{slug}
     */
    public function showPrivate(string $slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $content = Content::published()
            ->where('slug', $slug)
            ->where('visibility', ContentVisibility::PRIVATE)
            ->firstOrFail();

        return view('contents.show', compact('content'));
    }
}
