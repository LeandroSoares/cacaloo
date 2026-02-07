@extends('layouts.admin')

@section('title', 'Novo Conteúdo')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Novo Conteúdo
            </h2>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('admin.contents.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Voltar
            </a>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <form action="{{ route('admin.contents.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <!-- Título -->
                <div class="sm:col-span-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <div class="mt-1">
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>

                <!-- Slug -->
                <div class="sm:col-span-6">
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug (URL)</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                            {{ config('app.url') }}/
                        </span>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Sugerido: <span id="slug-suggestion" class="font-mono"></span></p>
                </div>

                <!-- Tipo -->
                <div class="sm:col-span-3">
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipo de Conteúdo</label>
                    <div class="mt-1">
                        <select id="type" name="type" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @foreach($types as $type)
                                <option value="{{ $type->value }}">{{ $type->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Visibilidade -->
                <div class="sm:col-span-3">
                    <label for="visibility" class="block text-sm font-medium text-gray-700">Visibilidade</label>
                    <div class="mt-1">
                        <select id="visibility" name="visibility" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @foreach($visibilities as $visibility)
                                <option value="{{ $visibility->value }}">{{ $visibility->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Conteúdo (Trix Editor) -->
                <div class="sm:col-span-6">
                    <label for="body" class="block text-sm font-medium text-gray-700 mb-2">Conteúdo</label>
                    <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                    <trix-editor input="body" class="trix-content min-h-[300px] border-gray-300 rounded-md shadow-sm"></trix-editor>
                </div>

                <!-- Data Publicação -->
                <div class="sm:col-span-3">
                    <label for="published_at" class="block text-sm font-medium text-gray-700">Data de Publicação</label>
                    <div class="mt-1">
                        <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>

                <!-- Ativo -->
                <div class="sm:col-span-3 flex items-center h-full pt-6">
                    <input type="hidden" name="is_active" value="0">
                    <input id="is_active" name="is_active" type="checkbox" value="1" checked class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    <label for="is_active" class="ml-3 block text-sm font-medium text-gray-700">
                        Conteúdo Ativo
                    </label>
                </div>
            </div>

            <div class="pt-5 border-t border-gray-200">
                <div class="flex justify-end">
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Salvar Conteúdo
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
@endpush

@push('scripts')
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

<script>
    // Slug Generator
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, "") // remove acentos
            .replace(/[^\w\s-]/g, '') // remove especial chars
            .replace(/\s+/g, '-') // spaces to dashes
            .replace(/^-+|-+$/g, ''); // trim dashes

        const slugInput = document.getElementById('slug');
        if (!slugInput.value || slugInput.dataset.touched !== 'true') {
            slugInput.value = slug;
            document.getElementById('slug-suggestion').textContent = slug;
        }
    });

    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.touched = 'true';
    });
</script>
@endpush
@endsection
