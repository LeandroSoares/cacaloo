@extends('layouts.admin')

@section('title', 'Detalhes do Tipo de Magia')

@section('content')
<div class="py-12">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Detalhes do Tipo de Magia</h1>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.magic-types.edit', $magicType) }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Editar
                    </a>
                    <a href="{{ route('admin.magic-types.index') }}"
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
                                <span class="text-sm font-medium text-gray-500">Nome:</span>
                                <span class="text-sm text-gray-900 ml-2">{{ $magicType->name }}</span>
                            </div>

                            <div>
                                <span class="text-sm font-medium text-gray-500">Status:</span>
                                @if($magicType->active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 ml-2">
                                        Ativo
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 ml-2">
                                        Inativo
                                    </span>
                                @endif
                            </div>

                            <div>
                                <span class="text-sm font-medium text-gray-500">Data de Criação:</span>
                                <span class="text-sm text-gray-900 ml-2">{{ $magicType->created_at->format('d/m/Y H:i') }}</span>
                            </div>

                            <div>
                                <span class="text-sm font-medium text-gray-500">Última Atualização:</span>
                                <span class="text-sm text-gray-900 ml-2">{{ $magicType->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h2 class="text-lg font-medium text-gray-900 mb-3">Estatísticas</h2>

                        <div class="space-y-3">
                            <div>
                                <span class="text-sm font-medium text-gray-500">Usuários com Magia:</span>
                                <span class="text-2xl font-bold text-blue-600 ml-2">{{ $magicType->divineMagics_count ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Descrição -->
            @if($magicType->description)
            <div class="mt-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-lg font-medium text-gray-900 mb-3">Descrição</h2>
                    <div class="prose max-w-none text-sm text-gray-700">
                        {!! nl2br(e($magicType->description)) !!}
                    </div>
                </div>
            </div>
            @endif

            <!-- Usuários com Magia -->
            @if($magicType->divineMagics && $magicType->divineMagics->count() > 0)
            <div class="mt-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-lg font-medium text-gray-900 mb-3">Usuários com Magia Recentemente</h2>

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
                                @foreach($magicType->divineMagics->take(10) as $magic)
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">
                                            {{ $magic->user->name ?? 'Usuário não encontrado' }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ $magic->created_at->format('d/m/Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($magicType->divineMagics->count() > 10)
                        <p class="mt-2 text-sm text-gray-500">
                            E mais {{ $magicType->divineMagics->count() - 10 }} usuários...
                        </p>
                    @endif
                </div>
            </div>
            @endif

            <!-- Ações -->
            <div class="mt-6 flex justify-end space-x-3">
                <form method="POST" action="{{ route('admin.magic-types.destroy', $magicType) }}"
                      onsubmit="return confirm('Tem certeza que deseja excluir este tipo de magia? Esta ação não pode ser desfeita.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Excluir Tipo de Magia
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
