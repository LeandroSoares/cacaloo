@extends('layouts.admin')

@section('title', 'Mensagens Diárias')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Cabeçalho da Página -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900">
                        Mensagens Diárias
                    </h1>
                    <div class="flex space-x-2">
                        @can('create daily messages')
                            <a href="{{ route('admin.daily-messages.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                <i class="fas fa-plus mr-2"></i>
                                Nova Mensagem
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filtros -->
        <div class="mb-6">
            <form method="GET" action="{{ route('admin.daily-messages.index') }}" class="flex flex-col lg:flex-row lg:items-end gap-4">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Buscar
                    </label>
                    <input type="text"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Buscar por título ou conteúdo..."
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="flex flex-col sm:flex-row gap-4 lg:gap-3">
                    <div class="sm:w-48">
                        <label for="search_author" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Autor
                        </label>
                        <input type="text"
                               id="search_author"
                               name="author"
                               value="{{ request('author') }}"
                               placeholder="Buscar por autor..."
                               class="w-full  border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="sm:w-36">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Status
                        </label>
                        <select id="status"
                                name="status"
                                class="w-full  border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            <option value="">Todos</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Ativo</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inativo</option>
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

        <!-- Desktop Table View -->
        <div class="hidden lg:block bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            @if($messages->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Título
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Autor
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Data de Criação
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($messages as $message)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium">
                                                <a href="{{ route('admin.daily-messages.show', $message) }}"
                                                   class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:underline transition-colors duration-200">
                                                    {{ Str::limit($message->title, 50) }}
                                                </a>
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ Str::limit($message->message, 80) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        @if($message->author)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                                {{ $message->author }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">Sem autor</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $message->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center">
                                            @if($message->active && $message->isValid())
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                    Ativo
                                                </span>
                                            @elseif($message->active)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                                    Inativo
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                                    Expirado
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="py-4 px-6 border-b border-gray-200 dark:border-gray-700 text-right">
                                        <div class="flex justify-end gap-5">
                                            <a href="{{ route('admin.daily-messages.show', $message) }}"
                                               class="inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:text-blue-300 dark:hover:bg-blue-900/20 rounded-lg transition-colors duration-200"
                                               title="Ver detalhes">
                                                <i class="fas fa-eye text-sm"></i>
                                            </a>

                                            <a href="{{ route('admin.daily-messages.edit', $message) }}"
                                               class="inline-flex items-center justify-center w-9 h-9 text-yellow-600 hover:text-yellow-700 hover:bg-yellow-50 dark:text-yellow-400 dark:hover:text-yellow-300 dark:hover:bg-yellow-900/20 rounded-lg transition-colors duration-200"
                                               title="Editar">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>

                                            <form method="POST" action="{{ route('admin.daily-messages.toggle-active', $message) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center w-9 h-9 {{ $message->active ? 'text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/20' : 'text-green-600 hover:text-green-700 hover:bg-green-50 dark:text-green-400 dark:hover:text-green-300 dark:hover:bg-green-900/20' }} rounded-lg transition-colors duration-200"
                                                        title="{{ $message->active ? 'Desativar mensagem' : 'Ativar mensagem' }}">
                                                    <i class="fas fa-{{ $message->active ? 'times-circle' : 'check-circle' }} text-sm"></i>
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('admin.daily-messages.destroy', $message) }}"
                                                  class="inline"
                                                  onsubmit="return confirm('Tem certeza que deseja excluir esta mensagem? Esta ação não pode ser desfeita.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/20 rounded-lg transition-colors duration-200"
                                                        title="Excluir mensagem">
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
                        <i class="fas fa-inbox text-4xl mb-4"></i>
                        <h3 class="text-lg font-medium mb-2">Nenhuma mensagem encontrada</h3>
                        <p class="text-sm">
                            @if(request()->hasAny(['search', 'author', 'status']))
                                Não há mensagens que correspondam aos filtros aplicados.
                            @else
                                Comece criando sua primeira mensagem diária.
                            @endif
                        </p>
                        @can('create daily messages')
                            <div class="mt-4">
                                <a href="{{ route('admin.daily-messages.create') }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                    <i class="fas fa-plus mr-2"></i>
                                    Criar Primeira Mensagem
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
            @endif
        </div>

        <!-- Mobile Card View -->
        <div class="lg:hidden space-y-4">
            @if($messages->count() > 0)
                @foreach($messages as $message)
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-2">
                                    <a href="{{ route('admin.daily-messages.show', $message) }}"
                                       class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:underline transition-colors duration-200">
                                        {{ Str::limit($message->title, 40) }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                    {{ Str::limit($message->message, 100) }}
                                </p>
                            </div>
                            <div class="flex items-center ml-4">
                                @if($message->active && $message->isValid())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                        Ativo
                                    </span>
                                @elseif($message->active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                        Inativo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                        Expirado
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-4">
                            @if($message->author)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                    {{ $message->author }}
                                </span>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">Sem autor</span>
                            @endif
                            <span>{{ $message->created_at->format('d/m/Y') }}</span>
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.daily-messages.show', $message) }}"
                               class="inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:text-blue-300 dark:hover:bg-blue-900/20 rounded-lg transition-colors duration-200"
                               title="Ver detalhes">
                                <i class="fas fa-eye text-sm"></i>
                            </a>

                            <a href="{{ route('admin.daily-messages.edit', $message) }}"
                               class="inline-flex items-center justify-center w-9 h-9 text-yellow-600 hover:text-yellow-700 hover:bg-yellow-50 dark:text-yellow-400 dark:hover:text-yellow-300 dark:hover:bg-yellow-900/20 rounded-lg transition-colors duration-200"
                               title="Editar">
                                <i class="fas fa-edit text-sm"></i>
                            </a>

                            <form method="POST" action="{{ route('admin.daily-messages.toggle-active', $message) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="inline-flex items-center justify-center w-9 h-9 {{ $message->active ? 'text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/20' : 'text-green-600 hover:text-green-700 hover:bg-green-50 dark:text-green-400 dark:hover:text-green-300 dark:hover:bg-green-900/20' }} rounded-lg transition-colors duration-200"
                                        title="{{ $message->active ? 'Desativar mensagem' : 'Ativar mensagem' }}">
                                    <i class="fas fa-{{ $message->active ? 'times-circle' : 'check-circle' }} text-sm"></i>
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.daily-messages.destroy', $message) }}"
                                  class="inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir esta mensagem? Esta ação não pode ser desfeita.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/20 rounded-lg transition-colors duration-200"
                                        title="Excluir mensagem">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-8 text-center">
                    <div class="text-gray-500 dark:text-gray-400">
                        <i class="fas fa-inbox text-4xl mb-4"></i>
                        <h3 class="text-lg font-medium mb-2">Nenhuma mensagem encontrada</h3>
                        <p class="text-sm mb-4">
                            @if(request()->hasAny(['search', 'author', 'status']))
                                Não há mensagens que correspondam aos filtros aplicados.
                            @else
                                Comece criando sua primeira mensagem diária.
                            @endif
                        </p>
                        @can('create daily messages')
                            <a href="{{ route('admin.daily-messages.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                <i class="fas fa-plus mr-2"></i>
                                Criar Primeira Mensagem
                            </a>
                        @endcan
                    </div>
                </div>
            @endif
        </div>

        <!-- Paginação -->
        @if($messages->hasPages())
            <div class="mt-6">
                {{ $messages->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
    </div>
</div>
@endsection
