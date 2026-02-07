<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - SysAdmin - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="h-full font-sans antialiased sysadmin-area" style="background: var(--bg-primary);">
    <div class="min-h-full">
        <!-- Navegação -->
        @include('layouts.navigation-sysadmin')

        <!-- Header da Página -->
        @if (isset($header))
            <header class="sysadmin-header shadow-xl">
                <div class="max-w-7xl mx-auto">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-bold text-white">
                            {{ $header }}
                        </h1>
                        <div class="flex items-center space-x-4">
                            <span class="text-purple-100 text-sm">
                                🔒 Administração do Sistema
                            </span>
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse" title="Sistema Online"></div>
                        </div>
                    </div>
                </div>
            </header>
        @endif

        <!-- Conteúdo Principal -->
        <main class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="space-y-6">
                    <!-- Aviso de Segurança Crítica -->
                    <div class="sysadmin-card border-l-4 border-red-500 p-4 bg-red-50">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Área de Máxima Segurança
                                </h3>
                                <p class="text-sm text-red-700 mt-1">
                                    Acesso restrito a administradores do sistema. Todas as ações são auditadas e logadas com timestamp completo.
                                </p>
                            </div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="sysadmin-card border-l-4 border-green-500 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">
                                        {{ session('success') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="sysadmin-card border-l-4 border-red-500 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">
                                        {{ session('error') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Informações do Sistema -->
                    <div class="sysadmin-card p-4 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                <span class="text-sm font-medium" style="color: var(--text-primary);">
                                    Sistema Operacional - Laravel {{ app()->version() }}
                                </span>
                            </div>
                            <div class="text-xs" style="color: var(--text-secondary);">
                                Última atualização: {{ now()->format('d/m/Y H:i:s') }}
                            </div>
                        </div>
                    </div>

                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-12 border-t border-gray-300" style="background: var(--bg-dark);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between">
                    <div>
                        <p style="color: var(--text-light);" class="text-sm">
                            © {{ date('Y') }} Casa de Caridade - Sistema de Administração
                        </p>
                        <p class="text-purple-300 text-xs mt-1">
                            Acesso autorizado apenas para administradores do sistema
                        </p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-xs text-gray-400">
                            Sessão: {{ substr(session()->getId(), 0, 8) }}...
                        </span>
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse" title="Conectado"></div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @livewireScripts
    @stack('scripts')
</body>
</html>
