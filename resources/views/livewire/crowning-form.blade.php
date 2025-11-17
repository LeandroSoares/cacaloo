<x-form-card title="Coroações" icon="👑">
    <form wire:submit.prevent="save" class="space-y-4">
        @if (session()->has('message'))
            <x-alert type="success">
                {{ session('message') }}
            </x-alert>
        @endif
        @if ($errors->any())
            <x-alert type="error">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ __($error) }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-600 mb-1">Data de Início</label>
                <input type="date" id="start_date" wire:model.defer="start_date" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-600 mb-1">Data de Fim</label>
                <input type="date" id="end_date" wire:model.defer="end_date" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                @error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="guide_name" class="block text-sm font-medium text-gray-600 mb-1">Nome do Guia</label>
                <input type="text" id="guide_name" wire:model.defer="guide_name" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                @error('guide_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="priest_name" class="block text-sm font-medium text-gray-600 mb-1">Nome do Sacerdote</label>
                <input type="text" id="priest_name" wire:model.defer="priest_name" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                @error('priest_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-2">
                <label for="temple_name" class="block text-sm font-medium text-gray-600 mb-1">Nome do Templo</label>
                <input type="text" id="temple_name" wire:model.defer="temple_name" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                @error('temple_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <x-button type="submit">
                Salvar Coroação
            </x-button>
        </div>
    </form>
</x-form-card>
