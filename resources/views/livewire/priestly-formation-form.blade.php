<x-form-card title="Formação Sacerdotal" icon="📿">
    <form wire:submit.prevent="save" class="space-y-6">
        @if ($errors->any())
            <x-alert type="error">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ __($error) }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif
        @if (session()->has('message'))
            <x-alert type="success">
                {{ session('message') }}
            </x-alert>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <div>
                <label for="theology_start" class="block text-sm font-medium text-gray-700">Início Teologia</label>
                <input type="date" id="theology_start" wire:model="theology_start" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('theology_start') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="theology_end" class="block text-sm font-medium text-gray-700">Fim Teologia</label>
                <input type="date" id="theology_end" wire:model="theology_end" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('theology_end') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="priesthood_start" class="block text-sm font-medium text-gray-700">Início Sacerdócio</label>
                <input type="date" id="priesthood_start" wire:model="priesthood_start" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('priesthood_start') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="priesthood_end" class="block text-sm font-medium text-gray-700">Fim Sacerdócio</label>
                <input type="date" id="priesthood_end" wire:model="priesthood_end" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('priesthood_end') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <x-button type="submit">
                Salvar Formação
            </x-button>
        </div>
    </form>
</x-form-card>
