@extends('layouts.admin')

@section('title', 'Categorias de Guias de Trabalho')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Categorias de Guias de Trabalho
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Gerencie as categorias de guias espirituais do sistema.
            </p>
        </div>
        <a href="{{ route('admin.work-guide-categories.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="fas fa-plus mr-2"></i> Nova Categoria
        </a>
    </div>

    {{-- Busca e Filtros --}}
    <div class="px-4 py-3 bg-gray-50 border-t border-b border-gray-200">
        <form method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nome ou slug..." class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="">Todos os status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Ativos</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inativos</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                <i class="fas fa-search"></i> Buscar
            </button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.work-guide-categories.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                    <i class="fas fa-times"></i> Limpar
                </a>
            @endif
        </form>
    </div>

    @if(session('success'))
        <div class="px-4 py-3 bg-green-50 border-l-4 border-green-500 text-green-700">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="border-t border-gray-200">
        @if($categories->isEmpty())
            <div class="px-4 py-5 sm:p-6 text-center text-gray-500">
                Nenhuma categoria encontrada.
            </div>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ordem
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Categoria
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Slug
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Usuários
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $category->display_order }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($category->icon)
                                    <span class="text-2xl mr-2">{{ $category->icon }}</span>
                                @endif
                                <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <code class="text-sm text-gray-600 bg-gray-100 px-2 py-1 rounded">{{ $category->slug }}</code>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($category->is_active)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Ativo
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i> Inativo
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $category->userValues()->count() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.work-guide-categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                            <form action="{{ route('admin.work-guide-categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza? Esta ação removerá todos os valores associados a esta categoria.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
