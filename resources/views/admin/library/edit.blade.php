@extends('layouts.admin')

@section('title', 'Editar Arquivo - Biblioteca')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Editar Arquivo</h1>
                    <p class="text-sm text-gray-600 mt-1">{{ $file->title }}</p>
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
                availableTags: @js($tags->pluck('name')->merge($file->tags->pluck('name'))->unique()->values()),
                selectedTags: @js(old('tags', $file->tags->pluck('name')->values()->all())),
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
            <form action="{{ route('admin.library.update', $file) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

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
                           value="{{ old('title', $file->title) }}"
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-700 focus:ring-green-700">
                </div>

                <!-- Tags Dinâmicas -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Tags / Categorias <span class="text-red-600">*</span>
                    </label>
                    <p class="text-xs text-gray-500 mb-3">
                        Selecione uma ou mais tags existentes ou crie novas tags abaixo.
                    </p>

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

                    <div class="flex gap-2">
                        <input type="text"
                               x-model="newTag"
                               name="custom_tags"
                               @keydown.enter.prevent="addCustomTag()"
                               placeholder="Digite uma nova tag e clique em Adicionar..."
                               class="flex-1 rounded-lg border-gray-300 text-sm shadow-sm focus:border-green-700 focus:ring-green-700">
                        <button type="button"
                                @click="addCustomTag()"
                                class="inline-flex items-center px-4 py-2 bg-amber-600 text-white text-xs font-semibold uppercase rounded-lg hover:bg-amber-700 transition">
                            <i class="fas fa-tag mr-1.5"></i>
                            Adicionar Tag
                        </button>
                    </div>

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
                              class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-700 focus:ring-green-700">{{ old('description', $file->description) }}</textarea>
                </div>

                <!-- Substituição Opcional de Arquivo e Capa -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-4 rounded-lg border border-gray-200 bg-gray-50">
                        <label for="file" class="block text-sm font-semibold text-gray-700 mb-1">
                            Substituir Arquivo Principal (opcional)
                        </label>
                        <p class="text-xs text-gray-600 mb-2">
                            Atual: <strong>{{ $file->original_name }}</strong> ({{ $file->formattedSize() }})
                        </p>
                        <input type="file"
                               id="file"
                               name="file"
                               accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.csv,.rtf,.odt,.ods,.odp,.jpg,.jpeg,.png,.webp,.gif"
                               class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-green-700 file:text-white hover:file:bg-green-800">
                    </div>

                    <div class="p-4 rounded-lg border border-gray-200 bg-gray-50">
                        <label for="cover" class="block text-sm font-semibold text-gray-700 mb-1">
                            Substituir Capa (opcional)
                        </label>
                        @if($file->cover_path)
                            <div class="flex items-center gap-3 mb-2">
                                <img src="{{ route('admin.library.cover', $file) }}" alt="Capa atual" class="w-12 h-12 rounded object-cover border">
                                <label class="inline-flex items-center text-xs text-red-700">
                                    <input type="checkbox" name="remove_cover" value="1" class="rounded border-gray-300 text-red-600 mr-1.5">
                                    Remover capa atual
                                </label>
                            </div>
                        @endif
                        <input type="file"
                               id="cover"
                               name="cover"
                               accept=".jpg,.jpeg,.png,.webp,.gif"
                               class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-gray-700 file:text-white hover:file:bg-gray-800">
                    </div>
                </div>

                <!-- Status -->
                <div class="flex items-center">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox"
                           id="is_active"
                           name="is_active"
                           value="1"
                           @checked(old('is_active', $file->is_active))
                           class="h-4 w-4 text-green-700 focus:ring-green-600 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">
                        Arquivo ativo (visível no portal)
                    </label>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.library.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-green-800 transition">
                        <i class="fas fa-save mr-2"></i>
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
