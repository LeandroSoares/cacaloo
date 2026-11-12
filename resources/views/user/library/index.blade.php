@extends('layouts.user')

@section('title', 'Biblioteca de Arquivos')

@section('content')
<div class="space-y-8">
    <!-- Hero / Cabeçalho com Identidade Oxóssi & Dourado -->
    <div class="rounded-3xl p-8 text-white shadow-lg relative overflow-hidden"
         style="background: linear-gradient(135deg, #1B4332 0%, #2E7D32 100%);">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider mb-3"
                      style="background: rgba(212, 175, 55, 0.25); color: #FDE68A;">
                    🌿 Conhecimento & Sabedoria
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                    Biblioteca de Arquivos
                </h1>
                <p class="mt-2 text-green-100 max-w-2xl text-sm sm:text-base">
                    Apostilas, orientações, estudos e materiais de apoio disponibilizados pela Casa para auxiliar na sua jornada espiritual.
                </p>
            </div>

            @can('library.manage')
                <div class="shrink-0">
                    <a href="{{ route('admin.library.index') }}"
                       class="inline-flex items-center px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition"
                       style="background: #D4AF37; color: #1A1A1A;">
                        <i class="fa-solid fa-gear mr-2"></i>
                        Gerenciar Biblioteca
                    </a>
                </div>
            @endcan
        </div>
    </div>

    <!-- Barra de Busca e Filtro por Tags -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 space-y-4">
        <form method="GET" action="{{ route('user.library.index') }}" class="grid grid-cols-1 sm:grid-cols-[1fr_240px_auto] gap-3">
            <div>
                <label for="search" class="sr-only">Buscar materiais</label>
                <input id="search"
                       name="search"
                       type="search"
                       value="{{ request('search') }}"
                       placeholder="Buscar por título, assunto ou tag..."
                       class="w-full rounded-xl border-gray-300 focus:border-green-700 focus:ring-green-700 text-sm">
            </div>

            <div>
                <label for="tag" class="sr-only">Filtrar por tag</label>
                <select id="tag"
                        name="tag"
                        class="w-full rounded-xl border-gray-300 focus:border-green-700 focus:ring-green-700 text-sm">
                    <option value="">Todas as categorias / tags</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->slug }}" @selected(request('tag') === $tag->slug)>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl font-semibold text-sm text-white transition"
                        style="background: #2E7D32;">
                    <i class="fa-solid fa-magnifying-glass mr-2"></i>
                    Filtrar
                </button>
                @if(request()->filled('search') || request()->filled('tag'))
                    <a href="{{ route('user.library.index') }}"
                       class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Limpar
                    </a>
                @endif
            </div>
        </form>

        @if($tags->count() > 0)
            <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-gray-100">
                <span class="text-xs font-semibold text-gray-500 mr-1">Tags:</span>
                <a href="{{ route('user.library.index', array_filter(['search' => request('search')])) }}"
                   class="px-3 py-1 rounded-full text-xs font-semibold transition {{ !request('tag') ? 'bg-green-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Todas
                </a>
                @foreach($tags as $tag)
                    <a href="{{ route('user.library.index', array_filter(['tag' => $tag->slug, 'search' => request('search')])) }}"
                       class="px-3 py-1 rounded-full text-xs font-semibold transition {{ request('tag') === $tag->slug ? 'bg-green-800 text-white' : 'bg-green-50 text-green-800 hover:bg-green-100' }}">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Grid de Arquivos -->
    @if($files->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($files as $file)
                <article class="flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm hover:shadow-md transition">
                    <div class="flex h-48 items-center justify-center overflow-hidden bg-gradient-to-br from-green-50 to-amber-50">
                        @if($file->cover_path)
                            <img src="{{ route('user.library.cover', $file) }}"
                                 alt="Capa: {{ $file->title }}"
                                 loading="lazy"
                                 class="h-full w-full object-cover">
                        @elseif($file->isImage())
                            <img src="{{ route('user.library.download', $file) }}"
                                 alt="{{ $file->title }}"
                                 loading="lazy"
                                 class="h-full w-full object-contain p-3">
                        @else
                            <div class="text-center p-4">
                                <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center mb-2"
                                     style="background: rgba(46, 125, 50, 0.12); color: #2E7D32;">
                                    <i class="fa-solid fa-file-lines text-3xl"></i>
                                </div>
                                <span class="block text-xs font-bold uppercase tracking-wider" style="color: #1B4332;">
                                    {{ strtoupper(pathinfo($file->original_name, PATHINFO_EXTENSION) ?: 'Documento') }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-1 flex-col p-5">
                        @if($file->tags->count() > 0)
                            <div class="mb-3 flex flex-wrap gap-1.5">
                                @foreach($file->tags as $tag)
                                    <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold"
                                          style="background: #E8F5E9; color: #1B4332;">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <h2 class="text-lg font-bold leading-snug text-gray-900">
                            {{ $file->title }}
                        </h2>

                        @if($file->description)
                            <p class="mt-2 whitespace-pre-line text-sm text-gray-600 line-clamp-3">
                                {{ $file->description }}
                            </p>
                        @endif

                        <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                            <span><i class="fa-regular fa-hard-drive mr-1"></i> {{ $file->formattedSize() }}</span>
                            <span><i class="fa-regular fa-calendar mr-1"></i> {{ $file->created_at->format('d/m/Y') }}</span>
                        </div>

                        <div class="mt-4 pt-2">
                            <a href="{{ route('user.library.download', $file) }}"
                               class="inline-flex w-full items-center justify-center rounded-xl px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-95"
                               style="background: #2E7D32;">
                                <i class="fa-solid fa-download mr-2"></i>
                                Baixar Arquivo
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $files->links() }}
        </div>
    @else
        <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-14 text-center">
            <div class="w-14 h-14 mx-auto rounded-full flex items-center justify-center mb-3"
                 style="background: #E8F5E9; color: #2E7D32;">
                <i class="fa-solid fa-book-open text-xl"></i>
            </div>
            <h2 class="text-lg font-semibold text-gray-900">Nenhum arquivo disponível no momento</h2>
            <p class="mt-1 text-sm text-gray-600">
                @if(request()->filled('search') || request()->filled('tag'))
                    Nenhum arquivo corresponde aos filtros selecionados.
                @else
                    Novos materiais de estudo e orientações serão publicados em breve pela administração da Casa.
                @endif
            </p>
        </div>
    @endif
</div>
@endsection
