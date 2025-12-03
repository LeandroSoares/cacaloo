<x-form-card title="Informações Religiosas" icon="🙏">
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
                <label for="start_date" class="block text-sm font-medium text-gray-700">Data de início na Umbanda</label>
                <input type="date" id="start_date" wire:model="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="start_location" class="block text-sm font-medium text-gray-700">Local de início</label>
                <input type="text" id="start_location" wire:model="start_location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('start_location') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="charity_house_start" class="block text-sm font-medium text-gray-700">Início na Casa de Caridade</label>
                <input type="date" id="charity_house_start" wire:model="charity_house_start" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('charity_house_start') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="charity_house_end" class="block text-sm font-medium text-gray-700">Término na Casa de Caridade</label>
                <input type="date" id="charity_house_end" wire:model="charity_house_end" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('charity_house_end') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="md:col-span-2">
                <label for="charity_house_observations" class="block text-sm font-medium text-gray-700">Observações</label>
                <textarea id="charity_house_observations" wire:model="charity_house_observations" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                @error('charity_house_observations') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="development_start" class="block text-sm font-medium text-gray-700">Início do Desenvolvimento</label>
                <input type="date" id="development_start" wire:model="development_start" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('development_start') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="development_end" class="block text-sm font-medium text-gray-700">Término do Desenvolvimento</label>
                <input type="date" id="development_end" wire:model="development_end" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('development_end') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="service_start" class="block text-sm font-medium text-gray-700">Início do Atendimento</label>
                <input type="date" id="service_start" wire:model="service_start" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('service_start') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="umbanda_baptism" class="block text-sm font-medium text-gray-700">Batismo na Umbanda</label>
                <input type="date" id="umbanda_baptism" wire:model="umbanda_baptism" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('umbanda_baptism') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="md:col-span-2">
                <label for="cambone_experience" class="block text-sm font-medium text-gray-700">Experiência como Cambone</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="hidden" wire:model="cambone_experience" value="0">
                        <input type="checkbox" id="cambone_experience" wire:model.live="cambone_experience" value="1" {{ $cambone_experience ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm">
                        <span class="ml-2">Sim</span>
                    </label>
                </div>
                @error('cambone_experience') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div x-show="$wire.cambone_experience">
                <label for="cambone_start_date" class="block text-sm font-medium text-gray-700">Data de Início como Cambone</label>
                <input type="date" id="cambone_start_date" wire:model="cambone_start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('cambone_start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div x-show="$wire.cambone_experience">
                <label for="cambone_end_date" class="block text-sm font-medium text-gray-700">Data de Término como Cambone</label>
                <input type="date" id="cambone_end_date" wire:model="cambone_end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('cambone_end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <x-button type="submit">
                Salvar Informações
            </x-button>
        </div>
    </form>
</x-form-card>
