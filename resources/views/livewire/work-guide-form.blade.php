<x-form-card title="Guias de Trabalho" icon="🕯️">
    <form wire:submit="save" class="space-y-6">
        @if (session()->has('message'))
            <x-alert type="success">
                {{ session('message') }}
            </x-alert>
        @endif

        @if($categories->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-info-circle text-3xl mb-2"></i>
                <p>Nenhuma categoria de guia disponível no momento.</p>
                <p class="text-sm mt-2">Entre em contato com o administrador.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                @foreach($categories as $category)
                    <div>
                        <label for="guide_{{ $category->id }}" class="block text-sm font-medium text-gray-700">
                            @if($category->icon)
                                <span class="mr-1">{{ $category->icon }}</span>
                            @endif
                            {{ $category->name }}
                        </label>
                        <input
                            type="text"
                            id="guide_{{ $category->id }}"
                            wire:model="values.{{ $category->id }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Nome do guia de {{ $category->name }}">
                        @error('values.' . $category->id)
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end mt-6">
                <x-button type="submit">
                    Salvar
                </x-button>
            </div>
        @endif
    </form>
</x-form-card>
