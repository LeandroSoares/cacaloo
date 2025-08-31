<div class="p-6 bg-white rounded-lg shadow-md mb-8 border border-gray-200">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Formação Sacerdotal</h2>
    <form wire:submit.prevent="save" class="space-y-6">
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ __($error) }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('message') }}
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">Salvar Formação</button>
        </div>
    </form>
</div>
