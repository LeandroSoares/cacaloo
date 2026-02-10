@extends('layouts.admin')

@section('title', 'Nova Categoria de Guia')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Nova Categoria de Guia de Trabalho
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            Preencha os dados para criar uma nova categoria.
        </p>
    </div>

    <form action="{{ route('admin.work-guide-categories.store') }}" method="POST" class="border-t border-gray-200">
        @csrf

        <div class="px-4 py-5 sm:p-6 space-y-6">
            {{-- Nome --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nome da Categoria *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Exemplo: Caboclo, Exu, Pombagira</p>
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug *</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('slug') border-red-500 @enderror">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Identificador único (sem espaços). Exemplo: caboclo, exu_mirim</p>
            </div>

            {{-- Ícone --}}
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700">Ícone (Emoji)</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon') }}" maxlength="50"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('icon') border-red-500 @enderror"
                    placeholder="🕯️">
                @error('icon')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Cole um emoji para representar esta categoria visualmente</p>
            </div>

            {{-- Ordem de Exibição --}}
            <div>
                <label for="display_order" class="block text-sm font-medium text-gray-700">Ordem de Exibição *</label>
                <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 0) }}" min="0" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('display_order') border-red-500 @enderror">
                @error('display_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Categorias serão ordenadas por este número (menor = primeiro)</p>
            </div>

            {{-- Status Ativo --}}
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                </div>
                <div class="ml-3 text-sm">
                    <label for="is_active" class="font-medium text-gray-700">Ativo</label>
                    <p class="text-gray-500">Se desmarcado, a categoria não aparecerá nos formulários dos usuários</p>
                </div>
            </div>
        </div>

        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 flex justify-between items-center">
            <a href="{{ route('admin.work-guide-categories.index') }}" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left mr-1"></i> Voltar
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-save mr-2"></i> Criar Categoria
            </button>
        </div>
    </form>
</div>

<script>
    // Auto-gerar slug a partir do nome
    document.getElementById('name').addEventListener('input', function(e) {
        const slug = e.target.value
            .toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Remove acentos
            .replace(/[^a-z0-9\s-]/g, '') // Remove caracteres especiais
            .trim()
            .replace(/\s+/g, '_'); // Substitui espaços por underscore
        document.getElementById('slug').value = slug;
    });
</script>
@endsection
