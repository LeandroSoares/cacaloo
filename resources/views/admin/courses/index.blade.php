@extends('layouts.admin')

@section('title', 'Gerenciar Cursos')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Cabeçalho da Página -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-graduation-cap mr-3 text-blue-600"></i>
                        Gerenciar Cursos
                    </h1>
                    <div class="flex space-x-2">
                        @can('create courses')
                            <a href="{{ route('admin.courses.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                <i class="fas fa-plus mr-2"></i>
                                Novo Curso
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Filtros -->
        <div class="mb-6">
            <form method="GET" action="{{ route('admin.courses.index') }}" class="flex flex-col lg:flex-row lg:items-end gap-4">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Buscar
                    </label>
                    <input type="text"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Buscar por nome ou descrição..."
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="flex flex-col sm:flex-row gap-4 lg:gap-3">
                    <div class="sm:w-36">
                        <label for="active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Status
                        </label>
                        <select id="active"
                                name="active"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            <option value="">Todos</option>
                            <option value="1" {{ request('active') === '1' ? 'selected' : '' }}>Ativo</option>
                            <option value="0" {{ request('active') === '0' ? 'selected' : '' }}>Inativo</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            <i class="fas fa-search mr-2"></i>
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden lg:block bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            @if($courses->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-graduation-cap mr-2"></i>
                                    Nome
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-align-left mr-2"></i>
                                    Descrição
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-toggle-on mr-2"></i>
                                    Status
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-users mr-2"></i>
                                    Usuários
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($courses as $course)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8">
                                                <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                    <i class="fas fa-graduation-cap text-blue-600 text-sm"></i>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $course->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 dark:text-white max-w-xs">
                                            {{ Str::limit($course->description, 80) ?: 'Sem descrição' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center">
                                            @if($course->active)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    Ativo
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                                    <i class="fas fa-times-circle mr-1"></i>
                                                    Inativo
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                                <i class="fas fa-users mr-1"></i>
                                                {{ $course->religiousCourses_count ?? 0 }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="py-4 px-6 border-b border-gray-200 dark:border-gray-700 text-right">
                                        <div class="flex justify-end gap-3">
                                            <a href="{{ route('admin.courses.show', $course) }}"
                                               class="inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:text-blue-300 dark:hover:bg-blue-900/20 rounded-lg transition-colors duration-200"
                                               title="Ver detalhes">
                                                <i class="fas fa-eye text-sm"></i>
                                            </a>

                                            <a href="{{ route('admin.courses.edit', $course) }}"
                                               class="inline-flex items-center justify-center w-9 h-9 text-yellow-600 hover:text-yellow-700 hover:bg-yellow-50 dark:text-yellow-400 dark:hover:text-yellow-300 dark:hover:bg-yellow-900/20 rounded-lg transition-colors duration-200"
                                               title="Editar">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>

                                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}"
                                                  class="inline"
                                                  onsubmit="return confirm('Tem certeza que deseja excluir este curso? Esta ação não pode ser desfeita.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/20 rounded-lg transition-colors duration-200"
                                                        title="Excluir curso">
                                                    <i class="fas fa-trash text-sm"></i>
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
                <div class="text-center py-12">
                    <div class="text-gray-500 dark:text-gray-400">
                        <i class="fas fa-graduation-cap text-4xl mb-4"></i>
                        <h3 class="text-lg font-medium mb-2">Nenhum curso encontrado</h3>
                        <p class="text-sm">
                            @if(request()->hasAny(['search', 'active']))
                                Não há cursos que correspondam aos filtros aplicados.
                            @else
                                Comece criando seu primeiro curso.
                            @endif
                        </p>
                        @can('create courses')
                            <div class="mt-4">
                                <a href="{{ route('admin.courses.create') }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                    <i class="fas fa-plus mr-2"></i>
                                    Criar Primeiro Curso
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
            @endif
        </div>

        <!-- Mobile Card View -->
        <div class="lg:hidden space-y-4">
            @if($courses->count() > 0)
                @foreach($courses as $course)
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-graduation-cap text-blue-600 text-sm"></i>
                                        </div>
                                    </div>
                                    <h3 class="ml-3 text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $course->name }}
                                    </h3>
                                </div>
                                @if($course->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                        {{ Str::limit($course->description, 100) }}
                                    </p>
                                @endif
                            </div>
                            <div class="flex items-center ml-4">
                                @if($course->active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Ativo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Inativo
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                <i class="fas fa-users mr-1"></i>
                                {{ $course->religiousCourses_count ?? 0 }} usuários
                            </span>
                            <span>{{ $course->created_at->format('d/m/Y') }}</span>
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.courses.show', $course) }}"
                               class="inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:text-blue-300 dark:hover:bg-blue-900/20 rounded-lg transition-colors duration-200"
                               title="Ver detalhes">
                                <i class="fas fa-eye text-sm"></i>
                            </a>

                            <a href="{{ route('admin.courses.edit', $course) }}"
                               class="inline-flex items-center justify-center w-9 h-9 text-yellow-600 hover:text-yellow-700 hover:bg-yellow-50 dark:text-yellow-400 dark:hover:text-yellow-300 dark:hover:bg-yellow-900/20 rounded-lg transition-colors duration-200"
                               title="Editar">
                                <i class="fas fa-edit text-sm"></i>
                            </a>

                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}"
                                  class="inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este curso? Esta ação não pode ser desfeita.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/20 rounded-lg transition-colors duration-200"
                                        title="Excluir curso">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-8 text-center">
                    <div class="text-gray-500 dark:text-gray-400">
                        <i class="fas fa-graduation-cap text-4xl mb-4"></i>
                        <h3 class="text-lg font-medium mb-2">Nenhum curso encontrado</h3>
                        <p class="text-sm mb-4">
                            @if(request()->hasAny(['search', 'active']))
                                Não há cursos que correspondam aos filtros aplicados.
                            @else
                                Comece criando seu primeiro curso.
                            @endif
                        </p>
                        @can('create courses')
                            <a href="{{ route('admin.courses.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                <i class="fas fa-plus mr-2"></i>
                                Criar Primeiro Curso
                            </a>
                        @endcan
                    </div>
                </div>
            @endif
        </div>

        <!-- Paginação -->
        @if($courses->hasPages())
            <div class="mt-6">
                {{ $courses->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
