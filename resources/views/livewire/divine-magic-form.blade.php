{{-- ESTE É UM FORM DO TIPO LISTA --}}
<x-form-card title="Magias Divinas" icon="🔮">
    @if (session()->has('message'))
        <x-alert type="success">
            {{ session('message') }}
        </x-alert>
    @endif

    <!-- Formulário para adicionar/editar magia divina -->
    <form wire:submit.prevent="save" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="magic_type_id" class="block text-sm font-medium text-gray-700">Tipo de Magia</label>
                <select wire:model="newMagic.magic_type_id" id="magic_type_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                    <option value="">Selecione um tipo de magia</option>
                    @foreach($availableMagicTypes as $magicType)
                        <option value="{{ $magicType['id'] }}">{{ $magicType['name'] }}</option>
                    @endforeach
                </select>
                @error('newMagic.magic_type_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Data da Consagração</label>
                <input type="date" wire:model="newMagic.date" id="date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('newMagic.date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="temple" class="block text-sm font-medium text-gray-700">Templo</label>
                <input type="text" wire:model="newMagic.temple" id="temple" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('newMagic.temple') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="priest_name" class="block text-sm font-medium text-gray-700">Nome do Sacerdote</label>
                <input type="text" wire:model="newMagic.priest_name" id="priest_name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('newMagic.priest_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="observations" class="block text-sm font-medium text-gray-700">Observações</label>
                <textarea wire:model="newMagic.observations" id="observations" rows="3" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                @error('newMagic.observations') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Botões -->
        <div class="flex justify-end mt-6 space-x-3">
            <x-button type="submit">
                @if($isEditing)
                    Atualizar Magia
                @else
                    Adicionar Magia
                @endif
            </x-button>

            @if($isEditing)
                <x-button type="button" wire:click="cancel" variant="secondary">
                    Cancelar
                </x-button>
            @endif
        </div>
    </form>

    <!-- Lista de magias já consagradas -->
    @if (count($divineMagics) > 0)
        <div class="mt-6 border-t pt-6">
            <h3 class="text-lg font-medium text-gray-700 mb-2">Magias Já Consagradas</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de Magia</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Templo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sacerdote</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($divineMagics as $index => $magic)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $magic['magic_type']['name'] }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ isset($magic['date']) ? \Carbon\Carbon::parse($magic['date'])->format('d/m/Y') : '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $magic['temple'] ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $magic['priest_name'] ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button wire:click="edit({{ $magic['id'] }})"
                                                class="text-blue-600 hover:text-blue-900">
                                            Editar
                                        </button>
                                        <button wire:click="delete({{ $magic['id'] }})"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Tem certeza que deseja remover esta magia?')">
                                            Excluir
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="mt-6 p-4 bg-gray-50 rounded text-gray-500">
            Nenhuma magia divina cadastrada até o momento.
        </div>
    @endif
</x-form-card>
