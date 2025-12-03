@extends('layouts.admin')

@section('title', 'Adicionar Orixá')

@section('content')
<div class="py-12">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Adicionar Orixá</h1>
                <a href="{{ route('admin.orishas.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Voltar
                </a>
            </div>

            <form method="POST" action="{{ route('admin.orishas.store') }}" class="space-y-6">
                @csrf

                <!-- Nome -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome *</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name') }}"
                           required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tipo -->
                <div>
                    <label for="type_orisha" class="block text-sm font-medium text-gray-700">Tipo</label>
                    <select name="type_orisha"
                            id="type_orisha"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('type_orisha') border-red-500 @enderror">
                        <option value="">Selecione...</option>
                        <option value="Universal" {{ old('type_orisha') == 'Universal' ? 'selected' : '' }}>Universal</option>
                        <option value="Cósmico" {{ old('type_orisha') == 'Cósmico' ? 'selected' : '' }}>Cósmico</option>
                    </select>
                    @error('type_orisha')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Trono -->
                <div>
                    <label for="throne" class="block text-sm font-medium text-gray-700">Trono</label>
                    <input type="text"
                           name="throne"
                           id="throne"
                           value="{{ old('throne') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('throne') border-red-500 @enderror">
                    @error('throne')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Trono -->
                <div>
                    <label for="throne" class="block text-sm font-medium text-gray-700">Trono</label>
                    <input type="text"
                           name="throne"
                           id="throne"
                           value="{{ old('throne') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('throne') border-red-500 @enderror">
                    @error('throne')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descrição -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Oferendas -->
                <div>
                    <label for="oferings" class="block text-sm font-medium text-gray-700">Oferendas</label>
                    <textarea name="oferings"
                              id="oferings"
                              rows="3"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('oferings') border-red-500 @enderror">{{ old('oferings') }}</textarea>
                    @error('oferings')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Texto Detalhado -->
                <div>
                    <label for="text" class="block text-sm font-medium text-gray-700">Texto Detalhado</label>
                    <textarea name="text"
                              id="text"
                              rows="10"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('text') border-red-500 @enderror">{{ old('text') }}</textarea>
                    @error('text')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ativo -->
                <div class="flex items-center">
                    <input type="hidden" name="active" value="0">
                    <input type="checkbox"
                           name="active"
                           id="active"
                           value="1"
                           {{ old('active', true) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="active" class="ml-2 block text-sm text-gray-700">
                        Ativo
                    </label>
                </div>

                <!-- Botões -->
                <div class="flex justify-end space-x-3 pt-6">
                    <a href="{{ route('admin.orishas.index') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
