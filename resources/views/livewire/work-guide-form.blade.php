<x-form-card title="Guias de Trabalho" icon="🕯️">
    <form wire:submit="save" class="space-y-6">
        @if (session()->has('message'))
            <x-alert type="success">
                {{ session('message') }}
            </x-alert>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Caboclo</label>
                <input type="text" wire:model="caboclo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('caboclo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Cabocla</label>
                <input type="text" wire:model="cabocla" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('cabocla') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Ogum</label>
                <input type="text" wire:model="ogum" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('ogum') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Xangô</label>
                <input type="text" wire:model="xango" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('xango') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Baiano</label>
                <input type="text" wire:model="baiano" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('baiano') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Baiana</label>
                <input type="text" wire:model="baiana" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('baiana') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Preto Velho</label>
                <input type="text" wire:model="preto_velho" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('preto_velho') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Preta Velha</label>
                <input type="text" wire:model="preta_velha" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('preta_velha') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Marinheiro</label>
                <input type="text" wire:model="marinheiro" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('marinheiro') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Erê</label>
                <input type="text" wire:model="ere" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('ere') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Exu</label>
                <input type="text" wire:model="exu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('exu') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Pombagira</label>
                <input type="text" wire:model="pombagira" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('pombagira') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Exu Mirim</label>
                <input type="text" wire:model="exu_mirim" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('exu_mirim') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <x-button type="submit">
                Salvar
            </x-button>
        </div>
    </form>
</x-form-card>
