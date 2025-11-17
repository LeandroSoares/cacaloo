<x-form-card title="Último Templo" icon="🏛️">
    <form wire:submit="save" class="space-y-6">
        @if (session()->has('message'))
            <x-alert type="success">
                {{ session('message') }}
            </x-alert>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nome do Templo</label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Endereço</label>
                <input type="text" id="address" wire:model="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="leader_name" class="block text-sm font-medium text-gray-700">Nome do Líder</label>
                <input type="text" id="leader_name" wire:model="leader_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('leader_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="function" class="block text-sm font-medium text-gray-700">Função Desempenhada</label>
                <input type="text" id="function" wire:model="function" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('function') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="exit_reason" class="block text-sm font-medium text-gray-700">Motivo da Saída</label>
                <textarea id="exit_reason" wire:model="exit_reason" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                @error('exit_reason') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <x-button type="submit">
                Salvar
            </x-button>
        </div>
    </form>
</x-form-card>
