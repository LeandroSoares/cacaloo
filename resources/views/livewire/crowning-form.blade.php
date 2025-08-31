<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
<div class="p-6 bg-white rounded-lg shadow-md mb-8 border border-gray-200">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Coroações</h2>
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
                <label for="start_date" class="block text-sm font-medium text-gray-700">Data de Início</label>
                <input type="date" id="start_date" wire:model="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Data de Fim</label>
                <input type="date" id="end_date" wire:model="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="guide_name" class="block text-sm font-medium text-gray-700">Nome do Guia</label>
                <input type="text" id="guide_name" wire:model="guide_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('guide_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="priest_name" class="block text-sm font-medium text-gray-700">Nome do Sacerdote</label>
                <input type="text" id="priest_name" wire:model="priest_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('priest_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="temple_name" class="block text-sm font-medium text-gray-700">Nome do Templo</label>
                <input type="text" id="temple_name" wire:model="temple_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('temple_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Salvar Coroação
            </button>
        </div>
    </form>
</div>
