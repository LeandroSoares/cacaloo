@extends('layouts.user')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-16">
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Meus Dados</h2>
                    <a href="{{ route('user.medium-history') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Ver Histórico Completo
                    </a>
                </div>
            </div>

            <livewire:personal-data-form :user="auth()->user()" />
            <br>
            <livewire:religious-info-form :user="auth()->user()" />
            <br>
            <livewire:priestly-formation-form :user="auth()->user()" />
            <br>
            <livewire:crowning-form :user="auth()->user()" />
            <br>
            <livewire:head-orisha-form :user="auth()->user()" />
            <br>
            <livewire:force-cross-form :user="auth()->user()" />
            <br>
            <livewire:crossing-form :user="auth()->user()" />
            <br>
            <livewire:work-guide-form :user="auth()->user()" />
            <br>
            <livewire:entity-consecration-form :user="auth()->user()" />
            <br>
            <livewire:amaci-form :user="auth()->user()" />
            <br>
            <livewire:religious-course-form :user="auth()->user()" />
            <br>
            <livewire:initiated-mystery-form :user="auth()->user()" />
            <br>
            <livewire:initiated-orisha-form :user="auth()->user()" />
            <br>
            <livewire:divine-magic-form :user="auth()->user()" />
            <br>
            <livewire:last-temple-form :user="auth()->user()" />
        </div>
    </div>
@endsection
