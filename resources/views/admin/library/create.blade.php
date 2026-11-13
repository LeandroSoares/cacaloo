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

        @php
            $tagItems = $tags->map(fn ($t) => [
                'id' => $t->id,
                'name' => $t->name,
                'destroyUrl' => route('admin.library.tags.destroy', $t),
            ])->values();
        @endphp

        <div class="bg-white shadow rounded-lg p-6"
             x-data="{
                availableTags: @js($tagItems),
                selectedTags: @js(old('tags', [])),
                newTag: '',
                tagError: '',
                tagNotice: '',
                toggleTag(tagName) {
                    this.tagError = '';
                    const idx = this.selectedTags.indexOf(tagName);
                    if (idx >= 0) {
                        this.selectedTags.splice(idx, 1);
                    } else {
                        if (this.selectedTags.length >= 8) {
                            this.tagError = 'Selecione no máximo 8 tags por arquivo.';
                            return;
                        }
                        this.selectedTags.push(tagName);
                    }
                },
                addCustomTag() {
                    this.tagError = '';
                    this.tagNotice = '';
                    const regex = /^[\p{L}\p{N}\s\-]+$/u;
                    const parts = this.newTag.split(',').map(t => t.replace(/\s+/g, ' ').trim()).filter(Boolean);
                    for (const clean of parts) {
                        if (clean.length < 2 || clean.length > {{ \App\Models\LibraryTag::MAX_NAME_LENGTH }}) {
                            this.tagError = `A tag &quot;${clean.substring(0, 24)}...&quot; deve ter entre 2 e {{ \App\Models\LibraryTag::MAX_NAME_LENGTH }} caracteres (não cole descrições aqui).`;
                            return;
                        }
                        if (!regex.test(clean)) {
                            this.tagError = `A tag &quot;${clean}&quot; contém pontuação inválida. Use apenas letras, números, espaços ou hífen.`;
                            return;
                        }
                        if (!this.selectedTags.some(t => t.toLowerCase() === clean.toLowerCase())) {
                            if (this.selectedTags.length >= 8) {
                                this.tagError = 'Selecione no máximo 8 tags por arquivo.';
                                return;
                            }
                            this.selectedTags.push(clean);
                        }
                        if (!this.availableTags.some(t => t.name.toLowerCase() === clean.toLowerCase())) {
                            this.availableTags.push({ id: null, name: clean, destroyUrl: null });
                        }
                    }
                    this.newTag = '';
                },
                async deleteTag(tagObj) {
                    this.tagError = '';
                    this.tagNotice = '';
                    if (!tagObj.destroyUrl) {
                        this.availableTags = this.availableTags.filter(t => t.name !== tagObj.name);
                        this.selectedTags = this.selectedTags.filter(t => t !== tagObj.name);
                        return;
                    }
                    if (!confirm(`Deseja excluir permanentemente a tag \"${tagObj.name}\" do sistema?`)) {
                        return;
                    }
                    try {
                        const res = await fetch(tagObj.destroyUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        });
                        if (res.ok) {
                            this.availableTags = this.availableTags.filter(t => t.name !== tagObj.name);
                            this.selectedTags = this.selectedTags.filter(t => t !== tagObj.name);
                            this.tagNotice = `Tag \"${tagObj.name}\" removida com sucesso.`;
                        }
                    } catch (e) {
                        this.tagError = 'Não foi possível remover a tag agora.';
                    }
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
                        Clique em uma tag para selecioná-la (máx. 8 tags, até {{ \App\Models\LibraryTag::MAX_NAME_LENGTH }} caracteres cada, sem pontuação). Para apagar uma tag indesejada do sistema, clique no <i class="fas fa-times text-red-500"></i>.
                    </p>

                    <template x-if="tagError">
                        <div class="mb-3 px-3 py-2 rounded-lg bg-red-50 border border-red-200 text-xs text-red-700" x-html="tagError"></div>
                    </template>
                    <template x-if="tagNotice">
                        <div class="mb-3 px-3 py-2 rounded-lg bg-green-50 border border-green-200 text-xs text-green-700" x-text="tagNotice"></div>
                    </template>

                    <!-- Chips das Tags Existentes -->
                    <div class="flex flex-wrap gap-2 mb-3">
                        <template x-for="tag in availableTags" :key="tag.name">
                            <div :class="selectedTags.includes(tag.name)
                                    ? 'bg-green-700 text-white border-green-700 shadow-sm'
                                    : 'bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200'"
                                 class="inline-flex items-center rounded-full text-xs font-semibold border transition">
                                <button type="button"
                                        @click="toggleTag(tag.name)"
                                        class="inline-flex items-center pl-3 pr-2 py-1.5">
                                    <span x-text="tag.name"></span>
                                    <i class="fas ml-1.5" :class="selectedTags.includes(tag.name) ? 'fa-check' : 'fa-plus text-gray-400'"></i>
                                </button>
                                <button type="button"
                                        @click.stop="deleteTag(tag)"
                                        :class="selectedTags.includes(tag.name) ? 'text-green-200 hover:text-white border-green-600' : 'text-red-500 hover:text-red-700 border-gray-300'"
                                        class="pr-2.5 pl-1.5 py-1.5 border-l transition"
                                        title="Excluir esta tag do sistema">
                                    <i class="fas fa-times text-[10px]"></i>
                                </button>
                            </div>
                        </template>
                    </div>

                    <!-- Criar Nova Tag na Hora -->
                    <div class="flex gap-2">
                        <input type="text"
                               x-model="newTag"
                               name="custom_tags"
                               maxlength="{{ \App\Models\LibraryTag::MAX_NAME_LENGTH }}"
                               @keydown.enter.prevent="addCustomTag()"
                               placeholder="Nova tag curta (até {{ \App\Models\LibraryTag::MAX_NAME_LENGTH }} caracteres, sem pontuação)..."
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
