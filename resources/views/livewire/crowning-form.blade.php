<div class="bg-white rounded-lg shadow p-6 mb-8 border border-gray-200">
    <h3 class="text-lg font-semibold mb-4 text-gray-700">Coroações</h3>
    <form wire:submit.prevent="save" class="space-y-4">
        @if (session()->has('message'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ __($error) }}</li>
                    @endforeach
                </ul>
            </div>
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
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">Salvar Coroação</button>
        </div>
    </form>
</div>
