@extends('layouts.admin')

@section('title', 'Biblioteca de Arquivos')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Cabeçalho -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Biblioteca de Arquivos
                    </h1>
                    <p class="text-sm text-gray-600 mt-1">
                        Gerencie documentos, apostilas, orientações e imagens disponíveis para os membros no portal.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('user.library.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 bg-white uppercase tracking-widest hover:bg-gray-50 transition">
                        <i class="fas fa-external-link-alt mr-2"></i>
                        Ver no Portal
                    </a>
                    @can('library.manage')
                        <a href="{{ route('admin.library.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 transition">
                            <i class="fas fa-plus mr-2"></i>
                            Novo Arquivo
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="bg-white shadow rounded-lg p-4 mb-6">
            <form method="GET" action="{{ route('admin.library.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                        Buscar
                    </label>
                    <input type="text"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Buscar por título, descrição, arquivo ou tag..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600">
                </div>

                <div>
                    <label for="tag" class="block text-sm font-medium text-gray-700 mb-1">
                        Tag / Categoria
                    </label>
                    <select id="tag"
                            name="tag"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600">
                        <option value="">Todas as tags</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->slug }}" @selected(request('tag') === $tag->slug)>
                                {{ $tag->name }} ({{ $tag->files_count }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <div class="flex-1">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status
                        </label>
                        <select id="status"
                                name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600">
                            <option value="">Todos</option>
                            <option value="active" @selected(request('status') === 'active')>Ativo</option>
                            <option value="inactive" @selected(request('status') === 'inactive')>Inativo</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 transition h-10">
                            <i class="fas fa-search mr-2"></i>
                            Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Listagem -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            @if($files->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Arquivo
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tags
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tamanho / Tipo
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Enviado em
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($files as $file)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0 w-12 h-12 rounded-lg overflow-hidden bg-green-50 border border-green-100 flex items-center justify-center">
                                                @if($file->cover_path)
                                                    <img src="{{ route('admin.library.cover', $file) }}" alt="{{ $file->title }}" class="w-full h-full object-cover">
                                                @else
                                                    <i class="fas {{ $file->isImage() ? 'fa-image text-amber-600' : 'fa-file-alt text-green-700' }} text-lg"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <a href="{{ route('admin.library.show', $file) }}" class="text-sm font-semibold text-gray-900 hover:text-green-700">
                                                    {{ $file->title }}
                                                </a>
                                                <div class="text-xs text-gray-500">
                                                    {{ Str::limit($file->original_name, 45) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($file->tags as $tag)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-600">
                                        <div class="font-medium text-gray-900">{{ $file->formattedSize() }}</div>
                                        <div>{{ $file->mime_type }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-600">
                                        <div>{{ $file->created_at->format('d/m/Y H:i') }}</div>
                                        @if($file->uploader)
                                            <div class="text-gray-400">por {{ $file->uploader->name }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($file->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Ativo
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                Inativo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ route('admin.library.download', $file) }}"
                                               class="inline-flex items-center justify-center w-8 h-8 text-green-700 hover:bg-green-50 rounded-lg"
                                               title="Baixar arquivo">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <a href="{{ route('admin.library.show', $file) }}"
                                               class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:bg-blue-50 rounded-lg"
                                               title="Detalhes">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.library.edit', $file) }}"
                                               class="inline-flex items-center justify-center w-8 h-8 text-amber-600 hover:bg-amber-50 rounded-lg"
                                               title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.library.toggle-active', $file) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center w-8 h-8 {{ $file->is_active ? 'text-amber-600 hover:bg-amber-50' : 'text-green-600 hover:bg-green-50' }} rounded-lg"
                                                        title="{{ $file->is_active ? 'Desativar' : 'Ativar' }}">
                                                    <i class="fas fa-{{ $file->is_active ? 'eye-slash' : 'check-circle' }}"></i>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.library.destroy', $file) }}"
                                                  class="inline"
                                                  onsubmit="return confirm('Tem certeza que deseja excluir permanentemente este arquivo da biblioteca?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:bg-red-50 rounded-lg"
                                                        title="Excluir">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12 px-4">
                    <i class="fas fa-folder-open text-4xl text-gray-400 mb-3"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Nenhum arquivo encontrado</h3>
                    <p class="text-sm text-gray-500 mb-4">
                        Comece adicionando apostilas, orientações ou documentos para disponibilizar aos membros.
                    </p>
                    <a href="{{ route('admin.library.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 transition">
                        <i class="fas fa-plus mr-2"></i>
                        Adicionar Primeiro Arquivo
                    </a>
                </div>
            @endif
        </div>

        @if($files->hasPages())
            <div class="mt-6">
                {{ $files->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
