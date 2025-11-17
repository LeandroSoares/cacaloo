@props(['sectionsVisibility' => []])

@php
// Debug - verificar o que está sendo passado
// dd('sectionsVisibility:', $sectionsVisibility); // Descomente para debugar

// Verificar visibilidade das seções para os links de navegação
// Se sectionsVisibility está vazio, usar valores padrão (para outras páginas)
// Se sectionsVisibility tem dados, usar os valores reais do banco
if (empty($sectionsVisibility)) {
    // Outras páginas - todos os links visíveis por padrão
    $aboutVisible = true;
    $eventsVisible = true;
    $contactVisible = true;
} else {
    // Home - usar valores reais do banco
    $aboutVisible = $sectionsVisibility['about']['is_visible'] ?? false;
    $eventsVisible = $sectionsVisibility['events']['is_visible'] ?? false;
    $contactVisible = $sectionsVisibility['contact']['is_visible'] ?? false;
}
@endphp

<header
    x-data="{
        isOpen: false,
        isScrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.isScrolled = window.scrollY > 50;
            });
        }
    }"
    x-init="init()"
    class="fixed top-0 left-0 right-0 z-50 bg-white transition-all duration-300"
    :class="isScrolled ? 'shadow-lg' : 'shadow-md'"
>
    <nav class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 focus-ring rounded-lg">
                <img
                    src="{{ asset('images/logo600x600.png') }}"
                    alt="Logo Casa de Caridade Legião de Oxóssi e Ogum"
                    class="h-12 w-12 rounded-full ring-2 ring-gold"
                >
                <span class="font-sans font-bold text-lg text-gray-900 hidden sm:block">
                    Casa de Caridade Legião de Oxóssi e Ogum
                </span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#inicio" class="text-gray-700 hover:text-oxossi font-medium transition-colors focus-ring px-3 py-2 rounded-lg">
                    Início
                </a>
                @if($aboutVisible)
                <a href="#sobre" class="text-gray-700 hover:text-oxossi font-medium transition-colors focus-ring px-3 py-2 rounded-lg">
                    Sobre Nós
                </a>
                @endif
                @if($eventsVisible)
                <a href="#eventos" class="text-gray-700 hover:text-oxossi font-medium transition-colors focus-ring px-3 py-2 rounded-lg">
                    Eventos
                </a>
                @endif
                @if($contactVisible)
                <a href="#contato" class="text-gray-700 hover:text-oxossi font-medium transition-colors focus-ring px-3 py-2 rounded-lg">
                    Contato
                </a>
                @endif

                <!-- Login Button -->
                <a href="{{ route('login') }}" class="bg-oxossi hover:bg-oxossi-dark text-white font-semibold px-4 py-2 rounded-lg transition-all duration-300 focus-ring shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Login
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button
                @click="isOpen = !isOpen"
                :aria-expanded="isOpen"
                :aria-label="isOpen ? 'Fechar menu' : 'Abrir menu'"
                class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100 focus-ring"
            >
                <!-- Hamburger Icon -->
                <svg
                    x-show="!isOpen"
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <!-- Close Icon -->
                <svg
                    x-show="isOpen"
                    x-cloak
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div
            x-show="isOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            @click.away="isOpen = false"
            class="md:hidden pb-4"
        >
            <div class="flex flex-col space-y-2">
                <a
                    href="#inicio"
                    @click="isOpen = false"
                    class="text-gray-700 hover:text-oxossi hover:bg-gray-50 font-medium px-4 py-3 rounded-lg transition-colors focus-ring"
                >
                    Início
                </a>
                @if($aboutVisible)
                <a
                    href="#sobre"
                    @click="isOpen = false"
                    class="text-gray-700 hover:text-oxossi hover:bg-gray-50 font-medium px-4 py-3 rounded-lg transition-colors focus-ring"
                >
                    Sobre Nós
                </a>
                @endif
                @if($eventsVisible)
                <a
                    href="#eventos"
                    @click="isOpen = false"
                    class="text-gray-700 hover:text-oxossi hover:bg-gray-50 font-medium px-4 py-3 rounded-lg transition-colors focus-ring"
                >
                    Eventos
                </a>
                @endif
                @if($contactVisible)
                <a
                    href="#contato"
                    @click="isOpen = false"
                    class="text-gray-700 hover:text-oxossi hover:bg-gray-50 font-medium px-4 py-3 rounded-lg transition-colors focus-ring"
                >
                    Contato
                </a>
                @endif

                <!-- Login Button Mobile -->
                <a
                    href="{{ route('login') }}"
                    @click="isOpen = false"
                    class="bg-oxossi hover:bg-oxossi-dark text-white font-semibold px-4 py-3 rounded-lg transition-all duration-300 focus-ring shadow-md text-center mt-2"
                >
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"/>
                    </svg>
                    Login
                </a>
            </div>
        </div>
    </nav>
</header>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
