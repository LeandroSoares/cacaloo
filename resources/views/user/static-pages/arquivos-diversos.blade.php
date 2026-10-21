@extends('layouts.user')
@section('title', 'Biblioteca de Arquivos')
@section('content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
<header class="mb-8 text-center">
    <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-emerald-700">Casa de Caridade</p>
    <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Biblioteca de Arquivos</h1>
    <p class="mx-auto mt-3 max-w-2xl text-gray-600">Documentos, orientações e imagens disponíveis para os membros da Casa.</p>
</header>
@if(session('success'))
        <div role="status" class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">{{ session('success') }}</div>
@endif
@if($errors->any())
        <div role="alert" class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
            <p class="font-semibold">Confira os campos:</p><ul class="mt-2 list-inside list-disc">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
@endif
@can('manage-casa-arquivos')
<section class="mb-8 rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm sm:p-7">
    <h2 class="text-xl font-bold text-gray-900">Adicionar arquivo</h2>
    <p class="mt-1 text-sm text-gray-600">Arquivo principal até 20 MB. Capa opcional até 5 MB.</p>
<form action="{{ route('biblioteca-arquivos.store') }}" method="POST" enctype="multipart/form-data" class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2">@csrf
<div>
    <label for="titulo" class="mb-1 block text-sm font-semibold text-gray-700">Título *</label>
    <input id="titulo" name="titulo" required maxlength="160" value="{{ old('titulo') }}" class="w-full rounded-lg border-gray-300 focus:border-emerald-600 focus:ring-emerald-600">
</div>
<div>
    <label for="categoria" class="mb-1 block text-sm font-semibold text-gray-700">Categoria *</label>
    <input id="categoria" name="categoria" required maxlength="100" list="categorias-sugeridas" value="{{ old('categoria') }}" placeholder="Ex.: Orientações, Estudos, Imagens" class="w-full rounded-lg border-gray-300 focus:border-emerald-600 focus:ring-emerald-600">
    <datalist id="categorias-sugeridas">
        <option value="Orientações"><option value="Estudos">
        <option value="Documentos"><option value="Imagens">
        <option value="Rituais e trabalhos">
    </datalist>
</div>
<div class="md:col-span-2"><label for="descricao" class="mb-1 block text-sm font-semibold text-gray-700">Descrição (opcional)</label>
    <textarea id="descricao" name="descricao" rows="3" maxlength="3000" class="w-full rounded-lg border-gray-300 focus:border-emerald-600 focus:ring-emerald-600">{{ old('descricao') }}</textarea>
</div>
<div>
    <label for="arquivo" class="mb-1 block text-sm font-semibold text-gray-700">Arquivo principal *</label>
    <input id="arquivo" name="arquivo" type="file" required accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.csv,.rtf,.odt,.ods,.odp,.jpg,.jpeg,.png,.webp,.gif" class="block w-full rounded-lg border border-gray-300 p-2 text-sm">
    <p class="mt-1 text-xs text-gray-500">PDF, Office, texto, planilhas, apresentações ou imagens.</p>
</div>
<div>
    <label for="capa" class="mb-1 block text-sm font-semibold text-gray-700">Capa do card (opcional)</label>
    <input id="capa" name="capa" type="file" accept=".jpg,.jpeg,.png,.webp,.gif" class="block w-full rounded-lg border border-gray-300 p-2 text-sm">
    <p class="mt-1 text-xs text-gray-500">JPG, PNG, WEBP ou GIF. Armazenamento privado.</p>
</div>
<div class="md:col-span-2">
    <button type="submit" class="rounded-lg bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">Enviar para a biblioteca</button>
</div>
</form>
</section>
@endcan
<form method="GET" action="{{ route('biblioteca-arquivos.index') }}" class="mb-6 grid grid-cols-1 gap-3 rounded-xl bg-white p-4 shadow-sm sm:grid-cols-[1fr_220px_auto]">
    <label class="sr-only" for="busca">Buscar arquivos</label>
    <input id="busca" name="busca" value="{{ request('busca') }}" type="search" placeholder="Buscar por título, descrição ou categoria..." class="w-full rounded-lg border-gray-300 focus:border-emerald-600 focus:ring-emerald-600">
    <label class="sr-only" for="categoria-filtro">Categoria</label>
    <select id="categoria-filtro" name="categoria" class="w-full rounded-lg border-gray-300 focus:border-emerald-600 focus:ring-emerald-600">
        <option value="">Todas as categorias</option>
        @foreach($categorias as $categoria)
        <option value="{{ $categoria }}" @selected(request('categoria') === $categoria)>{{ $categoria }}</option>
        @endforeach
    </select>
    <button class="rounded-lg border border-gray-300 px-5 py-2 font-semibold text-gray-700 hover:bg-gray-50" type="submit">Filtrar</button>
</form>
@if($arquivos->count())
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">@foreach($arquivos as $arquivo)
<article class="flex h-full flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition hover:shadow-md">
    <div class="flex h-48 items-center justify-center overflow-hidden bg-gradient-to-br from-emerald-50 to-amber-50">
@if($arquivo->capa_path)<img src="{{ route('biblioteca-arquivos.capa',$arquivo) }}" alt="Capa: {{ $arquivo->titulo }}" loading="lazy" class="h-full w-full object-cover">
@elseif($arquivo->eh_imagem)<img src="{{ route('biblioteca-arquivos.download',$arquivo) }}" alt="{{ $arquivo->titulo }}" loading="lazy" class="h-full w-full object-contain p-3">
@else 
    <div class="text-center"><svg class="mx-auto h-14 w-14 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M7 3.75h7l5 5v11.5a.75.75 0 0 1-.75.75h-11.5a.75.75 0 0 1-.75-.75V4.5a.75.75 0 0 1 .75-.75Z"/>
        <path stroke-linecap="round" stroke-linejoin="round" d="M14 4v5h5M8 13h8M8 16.5h8"/>
    </svg>
        <span class="mt-2 block text-xs font-bold uppercase tracking-wider text-emerald-800">Documento</span>
    </div>
@endif
</div>
    <div class="flex flex-1 flex-col p-5">
        <div class="mb-3"><span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-800">{{ $arquivo->categoria }}</span>
        </div>
        <h2 class="text-lg font-bold leading-snug text-gray-900">{{ $arquivo->titulo }}</h2>
        @if($arquivo->descricao)
        <p class="mt-2 whitespace-pre-line text-sm text-gray-600">{{ $arquivo->descricao }}</p>
        @endif
<div class="mt-3 text-xs text-gray-500">{{ number_format($arquivo->arquivo_tamanho/1048576,2,',','.') }} MB · {{ $arquivo->created_at->format('d/m/Y') }}
</div>
        <div class="mt-auto flex flex-wrap gap-2 pt-5"><a href="{{ route('biblioteca-arquivos.download',$arquivo) }}" class="inline-flex flex-1 items-center justify-center rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800">Baixar arquivo</a>
@can('manage-casa-arquivos')<form action="{{ route('biblioteca-arquivos.destroy',$arquivo) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir este arquivo da biblioteca?');">@csrf @method('DELETE')
    <button type="submit" class="rounded-lg border border-red-200 px-3 py-2.5 text-sm font-semibold text-red-700 hover:bg-red-50">Excluir</button>
</form>
@endcan
</div></div>
</article>@endforeach</div>
        <div class="mt-8">{{ $arquivos->links() }}</div>
@else 
        <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-14 text-center">
            <h2 class="text-lg font-semibold text-gray-900">Nenhum arquivo encontrado</h2>
            <p class="mt-2 text-sm text-gray-600">Altere os filtros ou adicione o primeiro arquivo, se tiver permissão.</p>
        </div>
@endif
</div></div>
@endsection
