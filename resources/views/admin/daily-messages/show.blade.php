@extends('layouts.admin')

@section('title', $dailyMessage->title)

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6 space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-gray-100">
                {{ $dailyMessage->title }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                Detalhes da mensagem do dia
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
            <a href="{{ route('admin.daily-messages.edit', $dailyMessage) }}"
               class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors text-center">
                <i class="fas fa-edit mr-2"></i>Editar
            </a>
            <a href="{{ route('admin.daily-messages.index') }}"
               class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors text-center">
                <i class="fas fa-arrow-left mr-2"></i>Voltar
            </a>
        </div>
    </div>

    <!-- Status Badges -->
    <div class="flex flex-wrap items-center space-x-3 mb-6">
        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $dailyMessage->active ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
            <i class="fas fa-{{ $dailyMessage->active ? 'check-circle' : 'times-circle' }} mr-1"></i>
            {{ $dailyMessage->active ? 'Ativo' : 'Inativo' }}
        </span>

        @if($dailyMessage->valid_from || $dailyMessage->valid_until)
            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $dailyMessage->isValid() ? 'bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100' }}">
                <i class="fas fa-calendar mr-1"></i>
                {{ $dailyMessage->isValid() ? 'Válida' : 'Expirada' }}
            </span>
        @endif

        @if($dailyMessage->isAvailable())
            <span class="px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 dark:bg-purple-800 dark:text-purple-100">
                <i class="fas fa-star mr-1"></i>
                Disponível para Exibição
            </span>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Conteúdo Principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Mensagem -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    <i class="fas fa-comment-alt mr-2"></i>Mensagem
                </h2>

                <div class="prose prose-sm dark:prose-invert max-w-none">
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 p-6 rounded-lg border-l-4 border-blue-400">
                        <p class="text-gray-900 dark:text-gray-100 leading-relaxed whitespace-pre-line">{{ $dailyMessage->message }}</p>

                        @if($dailyMessage->author)
                            <div class="mt-4 text-right">
                                <span class="text-sm text-gray-600 dark:text-gray-400 italic">
                                    — {{ $dailyMessage->author }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Notas Internas -->
            @if($dailyMessage->notes)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        <i class="fas fa-sticky-note mr-2"></i>Notas Internas
                    </h2>

                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <p class="text-gray-900 dark:text-gray-100 whitespace-pre-line">{{ $dailyMessage->notes }}</p>
                    </div>
                </div>
            @endif

            <!-- Preview -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    <i class="fas fa-eye mr-2"></i>Preview - Como aparece para os usuários
                </h2>
<div class="user-card bg-gradient-to-r from-green-50 to-yellow-50 border-l-4" style="border-color: var(--gold-main);">
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: var(--gold-main);">
                    <span class="text-white text-lg">✨</span>
                </div>
                <div>
                                            <h4 class="font-semibold text-lg" style="color: var(--oxossi-main);">
                            {{ $dailyMessage->title }}
                        </h4>
                        <p style="color: var(--text-secondary);" class="mt-2 italic whitespace-pre-line">
                            {{ $dailyMessage->message }}
                        </p>
                                                    <p class="text-sm mt-3" style="color: var(--gold-main);">
                               — {{ $dailyMessage->author }}
                            </p>
                                                            </div>
            </div>
        </div>
    </div>

            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Informações -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    <i class="fas fa-info-circle mr-2"></i>Informações
                </h2>

                <div class="space-y-4 text-sm">
                    <div>
                        <label class="block text-gray-500 dark:text-gray-400 font-medium mb-1">Status</label>
                        <span class="text-gray-900 dark:text-gray-100">
                            {{ $dailyMessage->active ? 'Ativa' : 'Inativa' }}
                        </span>
                    </div>

                    @if($dailyMessage->author)
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 font-medium mb-1">Autor</label>
                            <span class="text-gray-900 dark:text-gray-100">{{ $dailyMessage->author }}</span>
                        </div>
                    @endif

                    @if($dailyMessage->valid_from)
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 font-medium mb-1">Válida a partir de</label>
                            <span class="text-gray-900 dark:text-gray-100">{{ $dailyMessage->valid_from->format('d/m/Y') }}</span>
                        </div>
                    @endif

                    @if($dailyMessage->valid_until)
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 font-medium mb-1">Válida até</label>
                            <span class="text-gray-900 dark:text-gray-100">{{ $dailyMessage->valid_until->format('d/m/Y') }}</span>
                        </div>
                    @endif

                    <div>
                        <label class="block text-gray-500 dark:text-gray-400 font-medium mb-1">Criada em</label>
                        <span class="text-gray-900 dark:text-gray-100">{{ $dailyMessage->created_at->format('d/m/Y H:i') }}</span>
                    </div>

                    <div>
                        <label class="block text-gray-500 dark:text-gray-400 font-medium mb-1">Última atualização</label>
                        <span class="text-gray-900 dark:text-gray-100">{{ $dailyMessage->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Ações -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    <i class="fas fa-cogs mr-2"></i>Ações
                </h2>

                <div class="space-y-3">
                    <form method="POST" action="{{ route('admin.daily-messages.toggle-active', $dailyMessage) }}" class="w-full">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="w-full px-4 py-2 {{ $dailyMessage->active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg transition-colors">
                            <i class="fas fa-{{ $dailyMessage->active ? 'times-circle' : 'check-circle' }} mr-2"></i>
                            {{ $dailyMessage->active ? 'Desativar' : 'Ativar' }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.daily-messages.clear-cache') }}" class="w-full">
                        @csrf
                        <button type="submit"
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-refresh mr-2"></i>Limpar Cache
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.daily-messages.destroy', $dailyMessage) }}"
                          class="w-full"
                          onsubmit="return confirm('Tem certeza que deseja excluir esta mensagem? Esta ação não pode ser desfeita.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-trash mr-2"></i>Excluir Mensagem
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
