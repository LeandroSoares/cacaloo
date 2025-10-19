@props(['content' => [], 'sectionsVisibility' => []])

@php
$titleLine1 = $content['title_line1'] ?? 'Casa de Caridade';
$titleLine2 = $content['title_line2'] ?? 'Legião de Oxóssi e Ogum';
$subtitle = $content['subtitle'] ?? 'Um espaço de acolhimento, caridade e conexão espiritual dedicado aos Orixás Oxóssi e Ogum';
$backgroundImage = $content['background_image'] ?? asset('images/floresta1.jpg');
$backgroundColor = $content['background_color'] ?? '#2E7D32';
$isVisible = $content['is_visible'] ?? true;

// Verificar visibilidade das seções para os botões
$aboutVisible = $sectionsVisibility['about']['is_visible'] ?? true;
$contactVisible = $sectionsVisibility['contact']['is_visible'] ?? true;
@endphp

@if($isVisible)
<section id="inicio" class="relative min-h-screen flex items-center justify-center overflow-hidden">

    <!-- Background Image com Parallax -->
    <div class="absolute inset-0 z-0">
        <img
            src="{{ $backgroundImage }}"
            alt=""
            role="presentation"
            class="w-full h-full object-cover object-center"
            loading="eager"
        >
        <!-- Overlay Gradient -->
        <div class="absolute inset-0 hero-overlay" style="background-color: {{ $backgroundColor }}66;"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 py-20 text-center">

        <!-- Logo -->
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 100)"
            x-show="show"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="mb-8"
        >
            <img
                src="{{ asset('images/logo600x600.png') }}"
                alt="Logo Casa de Caridade Legião de Oxóssi e Ogum"
                class="w-32 h-32 lg:w-40 lg:h-40 mx-auto rounded-full ring-4 ring-gold shadow-2xl"
            >
        </div>

        <!-- Title -->
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 300)"
            x-show="show"
            x-transition:enter="transition ease-out duration-700 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="mb-6"
        >
            @if(!empty($titleLine1))
            <h1 class="font-sans font-bold text-white
                       text-4xl sm:text-5xl lg:text-6xl xl:text-7xl
                       leading-tight drop-shadow-2xl">
                {!! nl2br(e($titleLine1)) !!}
            </h1>
            @endif

            @if(!empty($titleLine2))
            <h1 class="font-sans font-bold text-gold
                       text-4xl sm:text-5xl lg:text-6xl xl:text-7xl
                       leading-tight drop-shadow-2xl">
                {!! nl2br(e($titleLine2)) !!}
            </h1>
            @endif
        </div>

        <!-- Subtitle -->
        <p
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 500)"
            x-show="show"
            x-transition:enter="transition ease-out duration-700 delay-300"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="text-white text-lg sm:text-xl lg:text-2xl mb-10 max-w-3xl mx-auto
                   leading-relaxed drop-shadow-lg"
        >
            {{ $subtitle }}
        </p>

        <!-- CTAs -->
        @if($aboutVisible || $contactVisible)
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 700)"
            x-show="show"
            x-transition:enter="transition ease-out duration-700 delay-500"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="flex flex-col sm:flex-row gap-4 justify-center items-center"
        >
            @if($aboutVisible)
            <x-ui.button
                href="#sobre"
                variant="primary"
                size="lg"
            >
                Saiba Mais
            </x-ui.button>
            @endif

            @if($contactVisible)
            <x-ui.button
                href="#contato"
                variant="secondary"
                size="lg"
            >
                Entre em Contato
            </x-ui.button>
            @endif
        </div>
        @endif
    </div>
</section>
@endif
