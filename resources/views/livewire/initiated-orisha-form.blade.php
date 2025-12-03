{{-- ESTE É UM FORM DO TIPO LISTA --}}
<x-form-card title="Orixás Iniciados" icon="⭐">
    @if (session()->has('message'))
        <x-alert type="success">
            {{ session('message') }}
        </x-alert>
    @endif

    <!-- Formulário para adicionar/editar orixá -->
    <form wire:submit.prevent="save" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <div>
                <label for="orisha_id" class="block text-sm font-medium text-gray-700">Orixá</label>
                <select wire:model="newOrisha.orisha_id" id="orisha_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                    <option value="">Selecione um orixá</option>
                    @foreach($availableOrishas as $orisha)
                        <option value="{{ $orisha['id'] }}">{{ $orisha['name'] }}</option>
                    @endforeach
                </select>
                @error('newOrisha.orisha_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="observations" class="block text-sm font-medium text-gray-700">Observações</label>
                <textarea wire:model="newOrisha.observations" id="observations" rows="3" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                @error('newOrisha.observations') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Botões -->
        <div class="flex justify-end mt-6 space-x-3">
            <x-button type="submit">
                @if($isEditing)
                    Atualizar Orixá
                @else
                    Adicionar Orixá
                @endif
            </x-button>

            @if($isEditing)
                <x-button type="button" wire:click="cancel" variant="secondary">
                    Cancelar
                </x-button>
            @endif
        </div>
    </form>

    <!-- Lista de orixás já iniciados -->
    @if (count($initiatedOrishas) > 0)
        <div class="mt-6 border-t pt-6">
            <h3 class="text-lg font-medium text-gray-700 mb-2">Orixás Já Iniciados</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orixá</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observações</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($initiatedOrishas as $index => $orisha)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $orisha['orisha']['name'] }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $orisha['observations'] ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button wire:click="edit({{ $orisha['id'] }})"
                                                class="text-blue-600 hover:text-blue-900">
                                            Editar
                                        </button>
                                        <button wire:click="delete({{ $orisha['id'] }})"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Tem certeza que deseja remover este orixá?')">
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
            Nenhum orixá iniciado cadastrado até o momento.
        </div>
    @endif
</x-form-card>
