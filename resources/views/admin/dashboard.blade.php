@extends('layouts.admin')

@section('title', 'Dashboard Administrativo')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Cabeçalho do Dashboard -->
        <div class="bg-white shadow rounded-lg mb-8">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            <i class="fas fa-tachometer-alt mr-3 text-blue-600"></i>
                            Dashboard Administrativo
                        </h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Visão geral e gerenciamento do sistema
                        </p>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <i class="fas fa-calendar mr-1"></i>
                        {{ now()->format('d/m/Y') }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-clock mr-1"></i>
                        {{ now()->format('H:i') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Estatísticas Rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total de Usuários -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total de Usuários</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ \App\Models\User::count() }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                            <i class="fas fa-arrow-right mr-1"></i>
                            Ver todos
                        </a>
                    </div>
                </div>
            </div>

            <!-- Convites Pendentes -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-envelope text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Convites Pendentes</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ \App\Models\Invitation::where('status', 'pending')->count() }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.invitations.index') }}"
                           class="inline-flex items-center text-sm text-yellow-600 hover:text-yellow-800">
                            <i class="fas fa-arrow-right mr-1"></i>
                            Gerenciar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Cursos Ativos -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Cursos Ativos</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ \App\Models\Course::where('active', true)->count() }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.courses.index') }}"
                           class="inline-flex items-center text-sm text-green-600 hover:text-green-800">
                            <i class="fas fa-arrow-right mr-1"></i>
                            Ver cursos
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mensagens Diárias -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-comment-alt text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Mensagens Diárias</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ \App\Models\DailyMessage::where('active', true)->count() }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.daily-messages.index') }}"
                           class="inline-flex items-center text-sm text-purple-600 hover:text-purple-800">
                            <i class="fas fa-arrow-right mr-1"></i>
                            Gerenciar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ações Rápidas -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Gerenciamento de Usuários -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-blue-50 dark:bg-blue-900/20 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        <i class="fas fa-users mr-2 text-blue-600"></i>
                        Gerenciamento de Usuários
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Gerencie usuários, convites e permissões do sistema.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center justify-center px-4 py-2 border border-blue-300 text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-md text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-list mr-2"></i>
                            Ver Usuários
                        </a>
                        <a href="{{ route('admin.users.create') }}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 rounded-md text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-user-plus mr-2"></i>
                            Novo Usuário
                        </a>
                        <a href="{{ route('admin.invitations.index') }}"
                           class="inline-flex items-center justify-center px-4 py-2 border border-yellow-300 text-yellow-700 bg-yellow-50 hover:bg-yellow-100 rounded-md text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-envelope mr-2"></i>
                            Ver Convites
                        </a>
                        <a href="{{ route('admin.invitations.create') }}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-yellow-600 text-white hover:bg-yellow-700 rounded-md text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Enviar Convite
                        </a>
                    </div>
                </div>
            </div>

            <!-- Conteúdo e Cursos -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-green-50 dark:bg-green-900/20 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        <i class="fas fa-graduation-cap mr-2 text-green-600"></i>
                        Conteúdo e Educação
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Gerencie cursos, mensagens diárias e conteúdo educacional.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <a href="{{ route('admin.courses.index') }}"
                           class="inline-flex items-center justify-center px-4 py-2 border border-green-300 text-green-700 bg-green-50 hover:bg-green-100 rounded-md text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-list mr-2"></i>
                            Ver Cursos
                        </a>
                        <a href="{{ route('admin.courses.create') }}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white hover:bg-green-700 rounded-md text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Novo Curso
                        </a>
                        <a href="{{ route('admin.daily-messages.index') }}"
                           class="inline-flex items-center justify-center px-4 py-2 border border-purple-300 text-purple-700 bg-purple-50 hover:bg-purple-100 rounded-md text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-comment-alt mr-2"></i>
                            Mensagens Diárias
                        </a>
                        <a href="{{ route('admin.daily-messages.create') }}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-purple-600 text-white hover:bg-purple-700 rounded-md text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Nova Mensagem
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Atividade Recente -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        <i class="fas fa-clock mr-2 text-gray-600"></i>
                        Atividade Recente
                    </h3>
                    <span class="text-sm text-gray-500">Últimas atualizações</span>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Últimos usuários registrados -->
                    @php
                        $recentUsers = \App\Models\User::latest()->limit(3)->get();
                        $recentInvites = \App\Models\Invitation::latest()->limit(3)->get();
                        $recentCourses = \App\Models\Course::latest()->limit(3)->get();
                    @endphp

                    @if($recentUsers->count() > 0)
                        <div class="border-l-4 border-blue-400 pl-4">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">
                                <i class="fas fa-user-plus mr-2 text-blue-600"></i>
                                Novos Usuários
                            </h4>
                            <div class="space-y-2">
                                @foreach($recentUsers as $user)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-blue-600 text-xs"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($recentInvites->count() > 0)
                        <div class="border-l-4 border-yellow-400 pl-4">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">
                                <i class="fas fa-envelope mr-2 text-yellow-600"></i>
                                Convites Recentes
                            </h4>
                            <div class="space-y-2">
                                @foreach($recentInvites as $invite)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-envelope text-yellow-600 text-xs"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $invite->email }}</p>
                                                <p class="text-xs text-gray-500">Status: {{ ucfirst($invite->status) }}</p>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-400">{{ $invite->created_at->diffForHumans() }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($recentCourses->count() > 0)
                        <div class="border-l-4 border-green-400 pl-4">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">
                                <i class="fas fa-graduation-cap mr-2 text-green-600"></i>
                                Cursos Recentes
                            </h4>
                            <div class="space-y-2">
                                @foreach($recentCourses as $course)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-graduation-cap text-green-600 text-xs"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $course->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $course->active ? 'Ativo' : 'Inativo' }}</p>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-400">{{ $course->created_at->diffForHumans() }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($recentUsers->count() == 0 && $recentInvites->count() == 0 && $recentCourses->count() == 0)
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            <i class="fas fa-inbox text-4xl mb-4"></i>
                            <p>Nenhuma atividade recente encontrada</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
