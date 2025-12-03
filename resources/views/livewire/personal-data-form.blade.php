<x-form-card title="Dados Pessoais" icon="👤">
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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-600 mb-1">Nome</label>
                <input type="text" id="name" wire:model.defer="name" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-gray-600 mb-1">Endereço</label>
                <input type="text" id="address" wire:model.defer="address" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="zip_code" class="block text-sm font-medium text-gray-600 mb-1">CEP</label>
                <input type="text" id="zip_code" wire:model.defer="zip_code" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                <input type="email" id="email" wire:model.defer="email" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="cpf" class="block text-sm font-medium text-gray-600 mb-1">CPF</label>
                <input type="text" id="cpf" wire:model.defer="cpf" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="rg" class="block text-sm font-medium text-gray-600 mb-1">RG</label>
                <input type="text" id="rg" wire:model.defer="rg" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-600 mb-1">Data de Nascimento</label>
                <input type="date" id="birth_date" wire:model.defer="birth_date" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="home_phone" class="block text-sm font-medium text-gray-600 mb-1">Telefone Fixo</label>
                <input type="text" id="home_phone" wire:model.defer="home_phone" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="mobile_phone" class="block text-sm font-medium text-gray-600 mb-1">Celular</label>
                <input type="text" id="mobile_phone" wire:model.defer="mobile_phone" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label for="work_phone" class="block text-sm font-medium text-gray-600 mb-1">Telefone Trabalho</label>
                <input type="text" id="work_phone" wire:model.defer="work_phone" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div class="md:col-span-2">
                <label for="emergency_contact" class="block text-sm font-medium text-gray-600 mb-1">Contato de Emergência</label>
                <input type="text" id="emergency_contact" wire:model.defer="emergency_contact" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <x-button type="submit">
                Salvar Dados
            </x-button>
        </div>
    </form>
</x-form-card>
