@extends('layouts.admin')

@section('title', 'Nova Mensagem do Dia')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-gray-100">
                Nova Mensagem do Dia
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                Crie uma nova mensagem inspiradora para os usuários
            </p>
        </div>

        <a href="{{ route('admin.daily-messages.index') }}"
           class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Voltar
        </a>
    </div>

    <!-- Formulário -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="POST" action="{{ route('admin.daily-messages.store') }}" class="space-y-6">
            @csrf

            <!-- Título -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Título *
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title') }}"
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
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-gray-100 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>

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
                       value="{{ old('author') }}"
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
                           value="{{ old('valid_from') }}"
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
                           value="{{ old('valid_until') }}"
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
                       {{ old('active', true) ? 'checked' : '' }}
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
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 dark:text-gray-100 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>

                @error('notes')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botões -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.daily-messages.index') }}"
                   class="px-6 py-3 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors text-center">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>Salvar Mensagem
                </button>
            </div>
        </form>
    </div>

    <!-- Dicas -->
    <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-400"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                    Dicas para uma boa mensagem do dia:
                </h3>
                <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Mantenha a mensagem inspiradora e positiva</li>
                        <li>Use linguagem acessível e inclusiva</li>
                        <li>Se definir um período de validade, a mensagem só aparecerá neste período</li>
                        <li>Mensagens inativas não serão exibidas para os usuários</li>
                        <li>O sistema escolhe aleatoriamente entre as mensagens ativas e válidas</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
