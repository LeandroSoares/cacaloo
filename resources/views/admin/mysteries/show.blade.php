@extends('layouts.admin')

@section('title', 'Detalhes do Mistério')

@section('content')
<div class="py-12">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Detalhes do Mistério</h1>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.mysteries.edit', $mystery) }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Editar
                    </a>
                    <a href="{{ route('admin.mysteries.index') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Voltar
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Informações Básicas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h2 class="text-lg font-medium text-gray-900 mb-3">Informações Básicas</h2>

                        <div class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nome</dt>
                                <dd class="text-sm text-gray-900">{{ $mystery->name }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="text-sm text-gray-900">
                                    @if($mystery->active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Ativo
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Inativo
                                        </span>
                                    @endif
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Data de Criação</dt>
                                <dd class="text-sm text-gray-900">{{ $mystery->created_at->format('d/m/Y H:i') }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Última Atualização</dt>
                                <dd class="text-sm text-gray-900">{{ $mystery->updated_at->format('d/m/Y H:i') }}</dd>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h2 class="text-lg font-medium text-gray-900 mb-3">Estatísticas</h2>

                        <div class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Usuários Iniciados</dt>
                                <dd class="text-2xl font-bold text-blue-600">{{ $mystery->initiatedMysteries_count ?? 0 }}</dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Descrição -->
            @if($mystery->description)
            <div class="mt-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-lg font-medium text-gray-900 mb-3">Descrição</h2>
                    <div class="prose max-w-none text-sm text-gray-700">
                        {!! nl2br(e($mystery->description)) !!}
                    </div>
                </div>
            </div>
            @endif

            <!-- Usuários Iniciados -->
            @if($mystery->initiatedMysteries && $mystery->initiatedMysteries->count() > 0)
            <div class="mt-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-lg font-medium text-gray-900 mb-3">Usuários Iniciados Recentemente</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Usuário
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Data de Iniciação
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($mystery->initiatedMysteries->take(10) as $initiated)
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">
                                            {{ $initiated->user->name ?? 'Usuário não encontrado' }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ $initiated->created_at->format('d/m/Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($mystery->initiatedMysteries->count() > 10)
                        <p class="mt-2 text-sm text-gray-500">
                            E mais {{ $mystery->initiatedMysteries->count() - 10 }} usuários...
                        </p>
                    @endif
                </div>
            </div>
            @endif

            <!-- Ações -->
            <div class="mt-6 flex justify-end space-x-3">
                <form method="POST" action="{{ route('admin.mysteries.destroy', $mystery) }}"
                      onsubmit="return confirm('Tem certeza que deseja excluir este mistério? Esta ação não pode ser desfeita.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Excluir Mistério
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
