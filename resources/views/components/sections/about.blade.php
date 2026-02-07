@props(['content' => []])

@php
$title = $content['title'] ?? 'Sobre Nossa Casa';
$subtitle = $content['subtitle'] ?? 'Conheça nossa história, missão e os Orixás que guiam nosso caminho';
$cards = $content['cards'] ?? [
    ['title' => 'Nossa História', 'content' => 'Conheça nossa trajetória espiritual', 'icon' => 'book'],
    ['title' => 'Nossa Missão', 'content' => 'Promover caridade e evolução espiritual', 'icon' => 'hands'],
    ['title' => 'Nossos Valores', 'content' => 'Fé, caridade e amor ao próximo', 'icon' => 'heart']
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

            @foreach($cards as $index => $card)
            <!-- Card {{ $index + 1 }}: {{ $card['title'] }} -->
            <div
                x-show="cards[{{ $index }}].show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                @if(isset($card['link_url']) && !empty($card['link_url']))
                    <a href="{{ $card['link_url'] }}" target="_blank" class="block h-full group">
                        <x-ui.card
                            :icon="$card['icon'] ?? 'star'"
                            :title="$card['title']"
                            :text="$card['content']"
                            class="h-full transition-transform duration-300 group-hover:-translate-y-1"
                        />
                    </a>
                @else
                    <x-ui.card
                        :icon="$card['icon'] ?? 'star'"
                        :title="$card['title']"
                        :text="$card['content']"
                        class="h-full"
                    />
                @endif
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif
