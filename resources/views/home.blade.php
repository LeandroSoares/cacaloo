<x-layout.app :home-content="$homeContent">
    <x-slot name="title">
        Home - Casa de Caridade Legião de Oxóssi e Ogum
    </x-slot>

    <!-- Hero Section -->
    <x-sections.hero :content="$homeContent['hero']" :sections-visibility="$homeContent" />

    <!-- Sobre Section -->
    <x-sections.about :content="$homeContent['about']" />

    <!-- Eventos Section -->
    <x-sections.events :content="$homeContent['events']" />

    <!-- Contato Section -->
    <x-sections.contact :content="$homeContent['contact']" />
</x-layout.app>
