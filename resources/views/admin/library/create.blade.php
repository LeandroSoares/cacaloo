@extends('layouts.admin')

@section('title', 'Novo Arquivo - Biblioteca')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Adicionar Arquivo à Biblioteca</h1>
                    <p class="text-sm text-gray-600 mt-1">Os arquivos ficam armazenados de forma privada e acessíveis apenas para usuários autenticados.</p>
                </div>
                <a href="{{ route('admin.library.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Voltar
                </a>
            </div>
        </div>

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-lg" role="alert">
                <p class="font-semibold">Por favor, corrija os erros abaixo:</p>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow rounded-lg p-6"
             x-data="{
                availableTags: @js($tags->pluck('name')->values()),
                selectedTags: @js(old('tags', [])),
                newTag: '',
                toggleTag(tag) {
                    const idx = this.selectedTags.indexOf(tag);
                    if (idx >= 0) {
                        this.selectedTags.splice(idx, 1);
                    } else {
                        this.selectedTags.push(tag);
                    }
                },
                addCustomTag() {
                    const parts = this.newTag.split(',').map(t => t.trim()).filter(Boolean);
                    parts.forEach(clean => {
                        if (!this.selectedTags.some(t => t.toLowerCase() === clean.toLowerCase())) {
                            this.selectedTags.push(clean);
                        }
                        if (!this.availableTags.some(t => t.toLowerCase() === clean.toLowerCase())) {
                            this.availableTags.push(clean);
                        }
                    });
                    this.newTag = '';
                }
             }">
            <form action="{{ route('admin.library.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">
                        Título do Arquivo <span class="text-red-600">*</span>
                    </label>
                    <input type="text"
                           id="title"
                           name="title"
                           required
                           maxlength="160"
                           value="{{ old('title') }}"
                           placeholder="Ex.: Apostila de Desenvolvimento Mediúnico - Módulo 1"
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-700 focus:ring-green-700">
                </div>

                <!-- Tags Dinâmicas -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Tags / Categorias <span class="text-red-600">*</span>
                    </label>
                    <p class="text-xs text-gray-500 mb-3">
                        Clique nas tags existentes para selecionar ou digite uma nova tag abaixo para criá-la na hora.
                    </p>

                    <!-- Chips das Tags Existentes -->
                    <div class="flex flex-wrap gap-2 mb-3">
                        <template x-for="tag in availableTags" :key="tag">
                            <button type="button"
                                    @click="toggleTag(tag)"
                                    :class="selectedTags.includes(tag)
                                        ? 'bg-green-700 text-white border-green-700 shadow-sm'
                                        : 'bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200'"
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold border transition">
                                <span x-text="tag"></span>
                                <i class="fas ml-1.5" :class="selectedTags.includes(tag) ? 'fa-check' : 'fa-plus text-gray-400'"></i>
                            </button>
                        </template>
                    </div>

                    <!-- Criar Nova Tag na Hora -->
                    <div class="flex gap-2">
                        <input type="text"
                               x-model="newTag"
                               name="custom_tags"
                               @keydown.enter.prevent="addCustomTag()"
                               placeholder="Digite uma nova tag e clique em Adicionar (ou pressione Enter)..."
                               class="flex-1 rounded-lg border-gray-300 text-sm shadow-sm focus:border-green-700 focus:ring-green-700">
                        <button type="button"
                                @click="addCustomTag()"
                                class="inline-flex items-center px-4 py-2 bg-amber-600 text-white text-xs font-semibold uppercase rounded-lg hover:bg-amber-700 transition">
                            <i class="fas fa-tag mr-1.5"></i>
                            Adicionar Tag
                        </button>
                    </div>

                    <!-- Inputs Hidden das Tags Selecionadas -->
                    <template x-for="tag in selectedTags" :key="'input-' + tag">
                        <input type="hidden" name="tags[]" :value="tag">
                    </template>
                </div>

                <!-- Descrição -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">
                        Descrição (opcional)
                    </label>
                    <textarea id="description"
                              name="description"
                              rows="4"
                              maxlength="3000"
                              placeholder="Resumo ou orientações sobre este material..."
                              class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-700 focus:ring-green-700">{{ old('description') }}</textarea>
                </div>

                <!-- Upload de Arquivo e Capa -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-4 rounded-lg border border-gray-200 bg-gray-50">
                        <label for="file" class="block text-sm font-semibold text-gray-700 mb-1">
                            Arquivo Principal (até 20 MB) <span class="text-red-600">*</span>
                        </label>
                        <input type="file"
                               id="file"
                               name="file"
                               required
                               accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.csv,.rtf,.odt,.ods,.odp,.jpg,.jpeg,.png,.webp,.gif"
                               class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-green-700 file:text-white hover:file:bg-green-800">
                        <p class="mt-2 text-xs text-gray-500">
                            Permitidos: PDF, Word, Excel, PowerPoint, TXT, CSV, ODT ou imagens (JPG, PNG, WEBP, GIF).
                        </p>
                    </div>

                    <div class="p-4 rounded-lg border border-gray-200 bg-gray-50">
                        <label for="cover" class="block text-sm font-semibold text-gray-700 mb-1">
                            Imagem de Capa do Card (opcional, até 5 MB)
                        </label>
                        <input type="file"
                               id="cover"
                               name="cover"
                               accept=".jpg,.jpeg,.png,.webp,.gif"
                               class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-gray-700 file:text-white hover:file:bg-gray-800">
                        <p class="mt-2 text-xs text-gray-500">
                            Opcional. Exibida no topo do card na Biblioteca (JPG, PNG, WEBP ou GIF).
                        </p>
                    </div>
                </div>

                <!-- Status -->
                <div class="flex items-center">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox"
                           id="is_active"
                           name="is_active"
                           value="1"
                           @checked(old('is_active', true))
                           class="h-4 w-4 text-green-700 focus:ring-green-600 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">
                        Arquivo ativo (visível imediatamente para todos os usuários autenticados no portal)
                    </label>
                </div>

                <!-- Botões -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.library.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 transition">
                        <i class="fas fa-cloud-upload-alt mr-2"></i>
                        Salvar na Biblioteca
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
