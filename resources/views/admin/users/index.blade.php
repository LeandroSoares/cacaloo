@extends('layouts.admin')

@section('title', 'Gerenciamento de Usuários')

@section('content')

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 sm:p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Novo Usuário
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white text-xs sm:text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-2 sm:py-3 sm:px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nome
                                    </th>
                                    <th class="py-2 px-2 sm:py-3 sm:px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="py-2 px-2 sm:py-3 sm:px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Papéis
                                    </th>
                                    <th class="py-2 px-2 sm:py-3 sm:px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-2 sm:py-4 sm:px-6 text-xs sm:text-sm text-gray-900">
                                            {{ $user->name }}
                                        </td>
                                        <td class="py-2 px-2 sm:py-4 sm:px-6 text-xs sm:text-sm text-gray-900">
                                            {{ $user->email }}
                                        </td>
                                        <td class="py-2 px-2 sm:py-4 sm:px-6 text-xs sm:text-sm text-gray-900">
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($user->roles as $role)
                                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                                        {{ $role->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="py-2 px-2 sm:py-4 sm:px-6 text-xs sm:text-sm font-medium">
                                            <div class="flex flex-col gap-1 sm:flex-row sm:gap-2">
                                                <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 text-center sm:text-left">Editar</a>

                                                @if($user->email !== 'admin@cacaloo.com.br')
                                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');" class="w-full sm:w-auto">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="w-full text-red-600 hover:text-red-900 text-center">Excluir</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
