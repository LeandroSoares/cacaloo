@extends('layouts.admin')

@section('title', 'Criar Convite')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('Criar Novo Convite') }}
                    </h2>

                    <form method="POST" action="{{ route('admin.invitations.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500">Um convite será enviado para este endereço de e-mail.</p>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="expires_days" :value="__('Dias de Validade')" />
                            <x-text-input id="expires_days" class="block mt-1 w-full" type="number" name="expires_days" :value="old('expires_days', 7)" min="1" max="30" />
                            <x-input-error :messages="$errors->get('expires_days')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500">Número de dias até que o convite expire (entre 1 e 30 dias).</p>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.invitations.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                                Cancelar
                            </a>
                            <x-primary-button class="ml-4">
                                {{ __('Enviar Convite') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
