@extends('layouts.admin')

@section('title', 'Editar Mensagem do Dia')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-gray-100">
                Editar Mensagem do Dia
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                Modificar mensagem: {{ $dailyMessage->title }}
            </p>
        </div>

        <div class="flex space-x-3">
            <a href="{{ route('admin.daily-messages.show', $dailyMessage) }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-eye mr-2"></i>Ver
            </a>
            <a href="{{ route('admin.daily-messages.index') }}"
               class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Voltar
            </a>
        </div>
    </div>

    <!-- Formulário -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="POST" action="{{ route('admin.daily-messages.update', $dailyMessage) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Título -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Título *
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title', $dailyMessage->title) }}"
                       placeholder="Ex: Pensamento do Dia"
                       required
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-gray-100 @error('title') border-red-500 @enderror">

                @error('title')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mensagem -->
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Mensagem *
                </label>
                <textarea id="message"
                          name="message"
                          rows="6"
                          placeholder="Escreva aqui a mensagem inspiradora que será exibida para os usuários..."
                          required
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-gray-100 @error('message') border-red-500 @enderror">{{ old('message', $dailyMessage->message) }}</textarea>

                @error('message')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Autor -->
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Autor
                </label>
                <input type="text"
                       id="author"
                       name="author"
                       value="{{ old('author', $dailyMessage->author) }}"
                       placeholder="Nome do autor da mensagem (opcional)"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-gray-100 @error('author') border-red-500 @enderror">

                @error('author')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Período de Validade -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="valid_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Válida a partir de
                    </label>
                    <input type="date"
                           id="valid_from"
                           name="valid_from"
                           value="{{ old('valid_from', $dailyMessage->valid_from?->format('Y-m-d')) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-gray-100 @error('valid_from') border-red-500 @enderror">

                    @error('valid_from')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="valid_until" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Válida até
                    </label>
                    <input type="date"
                           id="valid_until"
                           name="valid_until"
                           value="{{ old('valid_until', $dailyMessage->valid_until?->format('Y-m-d')) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-gray-100 @error('valid_until') border-red-500 @enderror">

                    @error('valid_until')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status Ativo -->
            <div class="flex items-center">
                <input type="checkbox"
                       id="active"
                       name="active"
                       value="1"
                       {{ old('active', $dailyMessage->active) ? 'checked' : '' }}
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded">
                <label for="active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                    Mensagem ativa (disponível para exibição)
                </label>
            </div>

            <!-- Notas -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Notas Internas
                </label>
                <textarea id="notes"
                          name="notes"
                          rows="3"
                          placeholder="Notas internas sobre a mensagem (não visível para usuários)"
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-gray-100 @error('notes') border-red-500 @enderror">{{ old('notes', $dailyMessage->notes) }}</textarea>

                @error('notes')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botões -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.daily-messages.show', $dailyMessage) }}"
                   class="px-6 py-3 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors text-center">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>Salvar Alterações
                </button>
            </div>
        </form>
    </div>

    <!-- Informações Adicionais -->
    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Histórico -->
        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
            <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-3">
                <i class="fas fa-clock mr-2"></i>Informações
            </h3>
            <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                <div>
                    <strong>Criada em:</strong> {{ $dailyMessage->created_at->format('d/m/Y H:i') }}
                </div>
                <div>
                    <strong>Última atualização:</strong> {{ $dailyMessage->updated_at->format('d/m/Y H:i') }}
                </div>
                @if($dailyMessage->valid_from || $dailyMessage->valid_until)
                    <div>
                        <strong>Status de validade:</strong>
                        <span class="px-2 py-1 rounded text-xs {{ $dailyMessage->isValid() ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                            {{ $dailyMessage->isValid() ? 'Válida' : 'Expirada' }}
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Dicas -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                        Lembrete:
                    </h3>
                    <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                        <p>As alterações serão aplicadas imediatamente. Se a mensagem está sendo exibida hoje, a nova versão aparecerá na próxima vez que o cache for renovado.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
