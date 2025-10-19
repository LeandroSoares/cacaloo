@props(['content' => []])

@php
$title = $content['title'] ?? 'Sobre Nossa Casa';
$subtitle = $content['subtitle'] ?? 'Conheça nossa história, missão e os Orixás que guiam nosso caminho';
$cards = $content['cards'] ?? [
    ['title' => 'Nossa História', 'content' => 'Conheça nossa trajetória espiritual', 'icon' => '📖'],
    ['title' => 'Nossa Missão', 'content' => 'Promover caridade e evolução espiritual', 'icon' => '🙏'],
    ['title' => 'Nossos Valores', 'content' => 'Fé, caridade e amor ao próximo', 'icon' => '💚']
];
$isVisible = $content['is_visible'] ?? true;
@endphp

@if($isVisible)
<section id="sobre" class="py-20 lg:py-32 bg-gray-50">
    <div class="container mx-auto px-4">

        <!-- Section Title -->
        <x-ui.section-title
            :title="$title"
            :subtitle="$subtitle"
        />

        <!-- Cards Grid -->
        <div
            x-data="{
                cards: @js(array_fill(0, count($cards), ['show' => false]))
            }"
            x-init="cards.forEach((card, i) => {
                setTimeout(() => card.show = true, i * 200);
            })"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12"
        >

            <!-- Card 1: História -->
            <div
                x-show="cards[0].show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                <x-ui.card
                    icon="book"
                    title="Nossa História"
                    text="A Casa de Caridade Legião de Oxóssi e Ogum foi fundada com o propósito de oferecer um espaço de acolhimento espiritual, caridade e desenvolvimento mediúnico. Ao longo dos anos, temos servido à comunidade com dedicação e amor."
                />
            </div>

            <!-- Card 2: Missão -->
            <div
                x-show="cards[1].show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                <x-ui.card
                    icon="heart"
                    title="Missão e Valores"
                    text="Nossa missão é promover a caridade, o amor ao próximo e o desenvolvimento espiritual através dos ensinamentos da Umbanda. Trabalhamos com fé, humildade e respeito às forças da natureza e aos Orixás."
                />
            </div>

            @foreach($cards as $index => $card)
            <!-- Card {{ $index + 1 }}: {{ $card['title'] }} -->
            <div
                x-show="cards[{{ $index }}].show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                <x-ui.card
                    :icon="$card['icon'] ?? 'star'"
                    :title="$card['title']"
                    :text="$card['content']"
                />
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif
