@extends('layouts.admin')

@section('title', 'Detalhes do Curso')

@section('content')
<div class="py-12">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">{{ $course->name }}</h1>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.courses.edit', $course) }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Editar Curso
                    </a>
                    <a href="{{ route('admin.courses.index') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Voltar para Lista
                    </a>
                </div>
            </div>

            <!-- Informações do Curso -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Dados Básicos -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Informações Básicas</h2>

                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-gray-500">Nome</label>
                                <p class="text-gray-900">{{ $course->name }}</p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500">Status</label>
                                <div>
                                    @if($course->active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Ativo
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Inativo
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if($course->description)
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Descrição</label>
                                    <p class="text-gray-900 whitespace-pre-wrap">{{ $course->description }}</p>
                                </div>
                            @endif

                            <div>
                                <label class="text-sm font-medium text-gray-500">Criado em</label>
                                <p class="text-gray-900">{{ $course->created_at->format('d/m/Y H:i') }}</p>
                            </div>

                            @if($course->updated_at->ne($course->created_at))
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Última atualização</label>
                                    <p class="text-gray-900">{{ $course->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Estatísticas -->
                <div>
                    <div class="bg-blue-50 rounded-lg p-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Estatísticas</h2>

                        <div class="space-y-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-600">
                                    {{ $course->religiousCourses->count() }}
                                </div>
                                <div class="text-sm text-gray-600">Usuários realizaram este curso</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Usuários que Realizaram o Curso -->
            @if($course->religiousCourses->count() > 0)
                <div class="mt-8">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Usuários que Realizaram este Curso</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Usuário
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Data do Curso
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Iniciação
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($course->religiousCourses as $religiousCourse)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $religiousCourse->user->name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $religiousCourse->user->email }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $religiousCourse->date->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($religiousCourse->finished)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Finalizado
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Em Andamento
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @if($religiousCourse->has_initiation)
                                                ✓ Sim
                                                @if($religiousCourse->initiation_date)
                                                    <div class="text-xs text-gray-500">
                                                        {{ $religiousCourse->initiation_date->format('d/m/Y') }}
                                                    </div>
                                                @endif
                                            @else
                                                Não
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
