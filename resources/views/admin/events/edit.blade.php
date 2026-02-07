@extends('layouts.admin')

@section('title', 'Editar Evento')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Editar Evento</h1>
        <a href="{{ route('admin.events.index') }}" class="text-gray-600 hover:text-gray-900">
            &larr; Voltar para lista
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <form action="{{ route('admin.events.update', $event) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Título -->
                <div class="col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título do Evento *</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Data Início -->
                <div>
                    <label for="event_date" class="block text-sm font-medium text-gray-700">Data e Hora *</label>
                    <input type="datetime-local" name="event_date" id="event_date"
                           value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('event_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Visibilidade -->
                <div>
                    <label for="visibility" class="block text-sm font-medium text-gray-700">Visibilidade *</label>
                    <select name="visibility" id="visibility" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="public" {{ old('visibility', $event->visibility->value) == 'public' ? 'selected' : '' }}>Público (Visível na Home)</option>
                        <option value="private" {{ old('visibility', $event->visibility->value) == 'private' ? 'selected' : '' }}>Privado (Apenas Logados)</option>
                    </select>
                    @error('visibility')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Local -->
                <div class="col-span-2">
                    <label for="location" class="block text-sm font-medium text-gray-700">Local (Opcional)</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Descrição -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição Curta *</label>
                    <textarea name="description" id="description" rows="3" required
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $event->description) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Esta descrição aparecerá no card da Home Page.</p>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Visibilidade Toggle -->
                <div class="col-span-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_visible" id="is_visible" value="1" {{ old('is_visible', $event->is_visible) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_visible" class="ml-2 block text-sm text-gray-900">
                            Evento Ativo (Visível no sistema)
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-gray-100">
                <a href="{{ route('admin.events.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 mr-3 transition-colors">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
