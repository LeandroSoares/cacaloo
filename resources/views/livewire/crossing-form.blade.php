{{-- ESTE É UM FORM DO TIPO LISTA --}}
<x-form-card title="Cruzamentos" icon="✨">
    <form wire:submit.prevent="save" class="space-y-6">
        @if (session()->has('message'))
            <x-alert type="success">
                {{ session('message') }}
            </x-alert>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
                <input type="date" id="date" wire:model="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="entity" class="block text-sm font-medium text-gray-700">Entidade</label>
                <input type="text" id="entity" wire:model="entity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('entity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="md:col-span-2">
                <label for="purpose" class="block text-sm font-medium text-gray-700">Propósito</label>
                <input type="text" id="purpose" wire:model="purpose" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('purpose') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-end mt-6">
            @if ($editingId)
                <x-button type="button" wire:click="cancel" variant="secondary" class="mr-3">
                    Cancelar
                </x-button>
            @endif
            <x-button type="submit">
                {{ $editingId ? 'Atualizar' : 'Adicionar' }} Cruzamento
            </x-button>
        </div>
    </form>

    <!-- Lista de Cruzamentos Registrados -->
    <div class="mt-8">
        @if (count($crossings) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Data</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Entidade</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Propósito</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($crossings as $crossing)
                            <tr wire:key="crossing-{{ $crossing->id }}" class="hover:bg-gray-50 {{ $editingId == $crossing->id ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}">
                                <td class="py-3 px-4 text-sm text-gray-900">
                                    {{ $crossing->date ? $crossing->date->format('d/m/Y') : '-' }}
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-900">
                                    {{ $crossing->entity ?: '-' }}
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-900">
                                    {{ $crossing->purpose ?: '-' }}
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-900">
                                    <button type="button"
                                            wire:click="edit({{ $crossing->id }})"
                                            class="text-blue-600 hover:text-blue-900 mr-3">
                                        {{ $editingId == $crossing->id ? '✓ Editando' : 'Editar' }}
                                    </button>
                                    <button type="button"
                                            wire:click="delete({{ $crossing->id }})"
                                            wire:confirm="Tem certeza que deseja excluir este cruzamento?"
                                            class="text-red-600 hover:text-red-900">
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <p>Nenhum cruzamento registrado ainda.</p>
                <p class="text-sm">Use o formulário acima para adicionar seu primeiro cruzamento.</p>
            </div>
        @endif
    </div>
</x-form-card>
