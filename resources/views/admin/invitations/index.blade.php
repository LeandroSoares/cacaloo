@extends('layouts.admin')

@section('title', 'Gerenciar Convites')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('Gerenciar Convites') }}
                    </h2>

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
                        <a href="{{ route('admin.invitations.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Novo Convite
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Convidado por
                                    </th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Data de Expiração
                                    </th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($invitations as $invitation)
                                    <tr>
                                        <td class="py-4 px-6 text-sm text-gray-900">
                                            {{ $invitation->email }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-900">
                                            {{ $invitation->inviter->name }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-900">
                                            {{ $invitation->expires_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-900">
                                            @if ($invitation->isAccepted())
                                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                    Aceito ({{ $invitation->accepted_at->format('d/m/Y') }})
                                                </span>
                                            @elseif ($invitation->isExpired())
                                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                                    Expirado
                                                </span>
                                            @elseif ($invitation->isCancelled())
                                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                                    Cancelado
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                                    Pendente
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium">
                                            <div class="flex space-x-2">
                                                @if (!$invitation->isAccepted() && !$invitation->isExpired() && !$invitation->isCancelled())
                                                    <form action="{{ route('admin.invitations.resend', $invitation) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">Reenviar</button>
                                                    </form>

                                                    <form action="{{ route('admin.invitations.cancel', $invitation) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar este convite?');">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-yellow-600 hover:text-yellow-900">Cancelar</button>
                                                    </form>
                                                @endif

                                                <form action="{{ route('admin.invitations.destroy', $invitation) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este convite?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Excluir</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 px-6 text-sm text-gray-500 text-center">
                                            Nenhum convite encontrado.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
