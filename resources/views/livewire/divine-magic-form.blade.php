<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Magias Divinas</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Lista de magias já consagradas -->
    @if (count($divineMagics) > 0)
        <div class="mb-6">
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
                                        {{ \Carbon\Carbon::parse($magic['date'])->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $magic['temple'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $magic['priest_name'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button wire:click="deleteMagic({{ $magic['id'] }})"
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Tem certeza que deseja remover esta magia?')">
                                        Remover
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="mb-6 p-4 bg-gray-50 rounded text-gray-500">
            Nenhuma magia divina cadastrada até o momento.
        </div>
    @endif

    <!-- Formulário para adicionar nova magia divina -->
    <h3 class="text-lg font-medium text-gray-700 mb-2">Adicionar Nova Magia Divina</h3>
    <form wire:submit.prevent="addMagic" class="space-y-4">
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

        <div class="pt-4">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Adicionar Magia
            </button>
        </div>
    </form>
</div>
