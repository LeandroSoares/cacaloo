@props(['homeContent' => null])

<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Casa de Caridade Legião de Oxóssi e Ogum - Um espaço de acolhimento espiritual, caridade e desenvolvimento mediúnico">

    <title>{{ $title ?? 'Casa de Caridade Legião de Oxóssi e Ogum' }}</title>

    <!-- Preconnect para fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js' ])

    {{ $head ?? '' }}
</head>
<body class="font-body text-gray-900 antialiased">

    <!-- Skip to main content (acessibilidade) -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-oxossi text-white px-4 py-2 rounded-lg z-50">
        Pular para conteúdo principal
    </a>

    <!-- Header/Navegação -->
    @if($homeContent)
        <x-layout.header :sections-visibility="$homeContent" />
    @else
        <x-layout.header />
    @endif

    <!-- Main Content -->
    <main id="main-content">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-layout.footer />

    <!-- Scripts adicionais -->
    {{ $scripts ?? '' }}
</body>
</html>
