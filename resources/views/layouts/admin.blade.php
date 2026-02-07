<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Administração - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="h-full font-sans antialiased bg-gray-50">
    <div x-data="{ sidebarOpen: false }" x-init="sidebarOpen = false" class="flex h-full min-h-screen">
        <!-- Sidebar -->
       <div x-cloak class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-4 bg-gray-800">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <h1 class="text-lg font-semibold text-white">Admin Panel</h1>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="mt-5 px-2 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                   class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200
                          {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt mr-3 text-gray-400 group-hover:text-gray-300"></i>
                    Dashboard
                </a>

                <!-- Gestão de Usuários -->
                <div class="space-y-1">
                    <div class="px-2 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Gestão de Usuários
                    </div>

                    <a href="{{ route('admin.users.index') }}"
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200
                              {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-users mr-3 text-gray-400 group-hover:text-gray-300"></i>
                        Usuários
                    </a>

                    <a href="{{ route('admin.invitations.index') }}"
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200
                              {{ request()->routeIs('admin.invitations.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-envelope mr-3 text-gray-400 group-hover:text-gray-300"></i>
                        Convites
                    </a>
                </div>

                <!-- Conteúdo Espiritual -->
                <div class="space-y-1">
                    <div class="px-2 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Conteúdo Espiritual
                    </div>

                    <a href="{{ route('admin.contents.index') }}"
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200
                              {{ request()->routeIs('admin.contents.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-file-alt mr-3 text-gray-400 group-hover:text-gray-300"></i>
                        Páginas / CMS
                    </a>

                    <a href="{{ route('admin.courses.index') }}"
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200
                              {{ request()->routeIs('admin.courses.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-graduation-cap mr-3 text-gray-400 group-hover:text-gray-300"></i>
                        Cursos
                    </a>

                    <a href="{{ route('admin.mysteries.index') }}"
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200
                              {{ request()->routeIs('admin.mysteries.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-eye mr-3 text-gray-400 group-hover:text-gray-300"></i>
                        Mistérios
                    </a>

                    <a href="{{ route('admin.orishas.index') }}"
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200
                              {{ request()->routeIs('admin.orishas.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-bolt mr-3 text-gray-400 group-hover:text-gray-300"></i>
                        Orixás
                    </a>

                    <a href="{{ route('admin.magic-types.index') }}"
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200
                              {{ request()->routeIs('admin.magic-types.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-magic mr-3 text-gray-400 group-hover:text-gray-300"></i>
                        Tipos de Magia
                    </a>

                    <a href="{{ route('admin.daily-messages.index') }}"
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200
                              {{ request()->routeIs('admin.daily-messages.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-comment-alt mr-3 text-gray-400 group-hover:text-gray-300"></i>
                        Mensagens do Dia
                    </a>
                </div>

                <!-- Customização -->
                <div class="space-y-1">
                    <div class="px-2 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Customização
                    </div>

                    <a href="{{ route('admin.home-customization.index') }}"
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200
                              {{ request()->routeIs('admin.home-customization.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-home mr-3 text-gray-400 group-hover:text-gray-300"></i>
                        Homepage
                    </a>
                </div>
            </nav>

            <!-- Sidebar Footer -->
            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-800">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-semibold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-white truncate">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-gray-400 truncate">
                            Administrador
                        </p>
                    </div>
                </div>

                <div class="mt-3 flex space-x-2">
                    <a href="{{ route('dashboard') }}"
                       class="flex-1 bg-gray-700 text-white text-xs px-3 py-2 rounded-md text-center hover:bg-gray-600 transition-colors duration-200">
                        <i class="fas fa-user mr-1"></i>
                        Área do Usuário
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit"
                                class="w-full bg-red-600 text-white text-xs px-3 py-2 rounded-md hover:bg-red-700 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt mr-1"></i>
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
    <div class="flex-1 flex flex-col">
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 lg:static lg:overflow-y-visible">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Mobile menu button -->
                            <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700">
                                <i class="fas fa-bars text-xl"></i>
                            </button>

                            <!-- Page title -->
                            <div class="ml-4 lg:ml-0">
                                <h1 class="text-lg font-semibold text-gray-900">
                                    @yield('title', 'Dashboard')
                                </h1>
                            </div>
                        </div>

                        <!-- Right side actions -->
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">
                                Painel Administrativo
                            </span>
                            @if(Auth::user()->hasRole('sysadmin'))
                                <a href="{{ route('sysadmin.dashboard') }}"
                                   class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                    <i class="fas fa-cog mr-1"></i>
                                    SysAdmin
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto">
                <div class="p-2 sm:p-6">
                    <!-- Alert Messages -->
                    @if (session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Security Notice -->
                    <div class="mb-6 bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt mr-2"></i>
                            <span class="text-sm">
                                Área restrita para administradores. Todas as ações são registradas para auditoria.
                            </span>
                        </div>
                    </div>

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" x-cloak
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="lg:hidden fixed inset-0 z-40 bg-gray-600 bg-opacity-75"
        @click="sidebarOpen = false"></div>
    @livewireScripts
</body>
</html>
