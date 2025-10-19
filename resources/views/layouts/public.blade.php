<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Casa de Caridade Legião de Oxóssi e Ogum - São Paulo')</title>

    <meta name="description" content="@yield('description', 'Casa de Caridade Legião de Oxóssi e Ogum. Um espaço de acolhimento, caridade e conexão espiritual dedicado aos Orixás Oxóssi e Ogum em São Paulo.')">
    <meta name="keywords" content="@yield('keywords', 'Umbanda, Oxóssi, Ogum, Casa de Caridade, São Paulo, Gira, Terreiro, Espiritualidade')">

    <!-- Preload Critical Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js', 'resources/js/custom.js'])

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', 'Casa de Caridade Legião de Oxóssi e Ogum')">
    <meta property="og:description" content="@yield('og_description', 'Um espaço de acolhimento, caridade e conexão espiritual dedicado aos Orixás Oxóssi e Ogum')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/logo600x600.png') }}">

    <!-- Configure Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'oxossi-green': '#2E7D32',
                        'oxossi-green-dark': '#1B5E20',
                        'ogum-red': '#C62828',
                        'ogum-red-dark': '#B71C1C',
                        'sacred-gold': '#D4AF37',
                        'whatsapp': '#25D366'
                    },
                    fontFamily: {
                        'heading': ['Montserrat', 'sans-serif'],
                        'body': ['Open Sans', 'sans-serif']
                    },
                    animation: {
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'fade-in-up': 'fadeInUp 0.6s ease-out'
                    }
                }
            }
        }
    </script>

    @stack('styles')
</head>
<body class="font-body text-gray-800 leading-relaxed">
    <!-- Skip to Main Content -->
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-oxossi-green text-white px-4 py-2 rounded-md z-50">
        Pular para conteúdo principal
    </a>

    @yield('content')

    @stack('scripts')
</body>
</html>
