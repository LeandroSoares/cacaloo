{{-- ESTE É UM FORM DO TIPO LISTA --}}
<x-form-card title="Amacis" icon="🌿">
    <form wire:submit="save" class="space-y-6">
        @if (session()->has('message'))
            <x-alert type="success">
                {{ session('message') }}
            </x-alert>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Tipo</label>
                <input type="text" id="type" wire:model="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
                <input type="date" id="date" wire:model="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="observations" class="block text-sm font-medium text-gray-700">Observações</label>
                <textarea id="observations" wire:model="observations" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                @error('observations') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex justify-end mt-6 space-x-3">
            @if($editingId)
                <x-button type="button" wire:click="cancel" variant="secondary">
                    Cancelar
                </x-button>
            @endif
            <x-button type="submit">
                {{ $editingId ? 'Atualizar' : 'Adicionar' }} Amaci
            </x-button>
        </div>
    </form>

    @if(count($amacis) > 0)
    <div class="mt-8">
        <h3 class="text-md font-medium text-gray-700 mb-4">Amacis Registrados</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observações</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($amacis as $amaci)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $amaci->type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $amaci->date?->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($amaci->observations, 30) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="edit({{ $amaci->id }})" class="text-indigo-600 hover:text-indigo-900 mr-2">Editar</button>
                            <button wire:click="delete({{ $amaci->id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir este registro?')">Excluir</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</x-form-card>
