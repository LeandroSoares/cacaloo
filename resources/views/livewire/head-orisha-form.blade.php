<x-form-card title="Orixás de Cabeça" icon="👤">
    <form wire:submit.prevent="save" class="space-y-6">
        @if (session()->has('message'))
            <x-alert type="success">
                {{ session('message') }}
            </x-alert>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <div class="md:col-span-2">
                <label for="ancestor" class="block text-sm font-medium text-gray-700">Orixá Ancestre</label>
                <input type="text" id="ancestor" wire:model="ancestor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('ancestor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="front" class="block text-sm font-medium text-gray-700">Orixá de Frente</label>
                <input type="text" id="front" wire:model="front" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('front') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="frontTogether" class="block text-sm font-medium text-gray-700">Orixá que anda junto (Frente)</label>
                <input type="text" id="frontTogether" wire:model="frontTogether" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('frontTogether') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="adjunct" class="block text-sm font-medium text-gray-700">Orixá Adjunto</label>
                <input type="text" id="adjunct" wire:model="adjunct" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('adjunct') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="adjunctTogether" class="block text-sm font-medium text-gray-700">Orixá que anda junto (Adjunto)</label>
                <input type="text" id="adjunctTogether" wire:model="adjunctTogether" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('adjunctTogether') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="rightSide" class="block text-sm font-medium text-gray-700">Orixá do Lado Direito</label>
                <input type="text" id="rightSide" wire:model="rightSide" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('rightSide') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="rightSideTogether" class="block text-sm font-medium text-gray-700">Orixá que anda junto (Lado Direito)</label>
                <input type="text" id="rightSideTogether" wire:model="rightSideTogether" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('rightSideTogether') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="leftSide" class="block text-sm font-medium text-gray-700">Orixá do Lado Esquerdo</label>
                <input type="text" id="leftSide" wire:model="leftSide" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('leftSide') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="leftSideTogether" class="block text-sm font-medium text-gray-700">Orixá que anda junto (Lado Esquerdo)</label>
                <input type="text" id="leftSideTogether" wire:model="leftSideTogether" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('leftSideTogether') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <x-button type="submit">
                Salvar Orixás
            </x-button>
        </div>
    </form>
</x-form-card>
