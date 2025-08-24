@extends('layouts.admin')

@section('title', 'Dashboard Administrativo')

@section('content')
<div class="py-12">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h1 class="text-2xl font-semibold mb-6">Painel Administrativo</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card Usuários -->
                <div class="bg-white p-6 rounded-lg border border-blue-200 shadow">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-blue-800">Usuários</h2>
                        <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                        </svg>
                    </div>
                    <p class="mt-2 text-gray-600">Gerencie os usuários do sistema.</p>
                    <div class="mt-4 flex space-x-3">
                        <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800">Ver todos →</a>
                        <a href="{{ route('admin.users.create') }}" class="text-green-600 hover:text-green-800">Adicionar novo +</a>
                    </div>
                </div>

                <!-- Card Papéis -->
                <div class="bg-white p-6 rounded-lg border border-purple-200 shadow">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-purple-800">Papéis</h2>
                        <svg class="w-8 h-8 text-purple-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <p class="mt-2 text-gray-600">Gerencie papéis e atribuições de usuários.</p>
                    <div class="mt-4 flex space-x-3">
                        <a href="{{ route('admin.roles.index') }}" class="text-purple-600 hover:text-purple-800">Ver todos →</a>
                    </div>
                </div>

                <!-- Card Convites -->
                <div class="bg-white p-6 rounded-lg border border-green-200 shadow">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-green-800">Convites</h2>
                        <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <p class="mt-2 text-gray-600">Gerencie convites para novos usuários.</p>
                    <div class="mt-4 flex space-x-3">
                        <a href="{{ route('admin.invitations.index') }}" class="text-green-600 hover:text-green-800">Ver todos →</a>
                        <a href="{{ route('admin.invitations.create') }}" class="text-green-600 hover:text-green-800">Enviar novo +</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
