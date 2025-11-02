<div class="p-6 bg-white rounded-lg shadow-md mb-8 border border-gray-200">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Consagrações</h2>
    <form wire:submit.prevent="save" class="space-y-6">
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ __($error) }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('message') }}
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="entity" class="block text-sm font-medium text-gray-700">Entidade</label>
                <input type="text" id="entity" wire:model="entity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('entity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nome Específico</label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
                <input type="date" id="date" wire:model="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-end mt-6">
            @if ($editingId)
                <button type="button" wire:click="cancel" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded shadow mr-3">Cancelar</button>
            @endif
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                {{ $editingId ? 'Atualizar' : 'Adicionar' }} Consagração
            </button>
        </div>
    </form>

    <!-- Lista de Consagrações Registradas -->
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Consagrações Registradas</h3>
        @if (count($consecrations) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Data</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Entidade</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Nome Específico</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($consecrations as $consecration)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm text-gray-900">
                                    {{ $consecration->date ? $consecration->date->format('d/m/Y') : '-' }}
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-900">
                                    {{ $consecration->entity ?: '-' }}
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-900">
                                    {{ $consecration->name ?: '-' }}
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-900">
                                    <button wire:click="edit({{ $consecration->id }})" class="text-blue-600 hover:text-blue-900 mr-3">
                                        Editar
                                    </button>
                                    <button wire:click="delete({{ $consecration->id }})"
                                            onclick="return confirm('Tem certeza que deseja excluir esta consagração?')"
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
                <p>Nenhuma consagração registrada ainda.</p>
                <p class="text-sm">Use o formulário acima para adicionar sua primeira consagração.</p>
            </div>
        @endif
    </div>
</div>
