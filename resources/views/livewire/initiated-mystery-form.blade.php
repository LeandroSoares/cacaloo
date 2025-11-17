{{-- ESTE É UM FORM DO TIPO LISTA --}}
<x-form-card title="Mistérios Iniciados" icon="🌙">
    @if (session()->has('message'))
        <x-alert type="success">
            {{ session('message') }}
        </x-alert>
    @endif

    <!-- Formulário para adicionar/editar mistério -->
    <form wire:submit.prevent="save" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="mystery_id" class="block text-sm font-medium text-gray-700">Mistério</label>
                <select wire:model="newMystery.mystery_id" id="mystery_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                    <option value="">Selecione um mistério</option>
                    @foreach($availableMysteries as $mystery)
                        <option value="{{ $mystery['id'] }}">{{ $mystery['name'] }}</option>
                    @endforeach
                </select>
                @error('newMystery.mystery_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Data da Iniciação</label>
                <input type="date" wire:model="newMystery.date" id="date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('newMystery.date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="temple" class="block text-sm font-medium text-gray-700">Templo</label>
                <input type="text" wire:model="newMystery.temple" id="temple" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('newMystery.temple') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="priest_name" class="block text-sm font-medium text-gray-700">Nome do Sacerdote</label>
                <input type="text" wire:model="newMystery.priest_name" id="priest_name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('newMystery.priest_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="observations" class="block text-sm font-medium text-gray-700">Observações</label>
                <textarea wire:model="newMystery.observations" id="observations" rows="3" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                @error('newMystery.observations') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Botões -->
        <div class="flex justify-end mt-6 space-x-3">
            <x-button type="submit">
                @if($isEditing)
                    Atualizar Mistério
                @else
                    Adicionar Mistério
                @endif
            </x-button>

            @if($isEditing)
                <x-button type="button" wire:click="cancel" variant="secondary">
                    Cancelar
                </x-button>
            @endif
        </div>
    </form>

    <!-- Lista de mistérios já iniciados -->
    @if (count($initiatedMysteries) > 0)
        <div class="mt-6 border-t pt-6">
            <h3 class="text-lg font-medium text-gray-700 mb-2">Mistérios Já Iniciados</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mistério</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Templo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sacerdote</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($initiatedMysteries as $index => $mystery)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $mystery['mystery']['name'] }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ isset($mystery['date']) ? \Carbon\Carbon::parse($mystery['date'])->format('d/m/Y') : '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $mystery['temple'] ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $mystery['priest_name'] ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button wire:click="edit({{ $mystery['id'] }})"
                                                class="text-blue-600 hover:text-blue-900">
                                            Editar
                                        </button>
                                        <button wire:click="delete({{ $mystery['id'] }})"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Tem certeza que deseja remover este mistério?')">
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
            Nenhum mistério iniciado cadastrado até o momento.
        </div>
    @endif
</x-form-card>
