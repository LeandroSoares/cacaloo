<x-form-card title="Cruz de Força" icon="✝️">
    <form wire:submit.prevent="save" class="space-y-6">
        @if (session()->has('message'))
            <x-alert type="success">
                {{ session('message') }}
            </x-alert>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="top" class="block text-sm font-medium text-gray-700">Alto</label>
                <input type="text" id="top" wire:model="top" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('top') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="bottom" class="block text-sm font-medium text-gray-700">Embaixo</label>
                <input type="text" id="bottom" wire:model="bottom" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('bottom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="left" class="block text-sm font-medium text-gray-700">Esquerdo</label>
                <input type="text" id="left" wire:model="left" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('left') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="right" class="block text-sm font-medium text-gray-700">Direito</label>
                <input type="text" id="right" wire:model="right" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('right') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <x-button type="submit">
                Salvar Cruz de Força
            </x-button>
        </div>
    </form>
</x-form-card>
