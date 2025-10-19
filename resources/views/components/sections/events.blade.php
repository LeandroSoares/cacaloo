@props(['content' => []])

@php
$title = $content['title'] ?? 'Giras e Eventos';
$subtitle = $content['subtitle'] ?? 'Confira nossa programação e participe conosco';
$events = $content['events'] ?? [];
$isVisible = $content['is_visible'] ?? true;
@endphp

@if($isVisible)
<section id="eventos" class="py-20 lg:py-32 bg-white">
    <div class="container mx-auto px-4">

        <!-- Section Title -->
        <x-ui.section-title
            :title="$title"
            :subtitle="$subtitle"
        />

        <!-- Events List -->
        <div
            x-data="{
                events: [
                    {
                        day: '25',
                        month: 'OUT',
                        title: 'Gira de Caboclos',
                        time: 'Sexta-feira às 20h00',
                        description: 'Trabalho espiritual com os Caboclos da mata, entidades de Oxóssi que trazem mensagens de força e sabedoria.',
                        show: false
                    },
                    {
                        day: '28',
                        month: 'OUT',
                        title: 'Gira de Pretos-Velhos',
                        time: 'Segunda-feira às 20h00',
                        description: 'Trabalho de caridade e aconselhamento com os sábios Pretos-Velhos, que trazem paz e conforto espiritual.',
                        show: false
                    },
                    {
                        day: '01',
                        month: 'NOV',
                        title: 'Gira de Exú',
                        time: 'Sexta-feira às 20h00',
                        description: 'Trabalho de limpeza espiritual e abertura de caminhos com os guardiões Exús.',
                        show: false
                    }
                ]
            }"
            x-init="events.forEach((event, i) => {
                setTimeout(() => event.show = true, i * 150);
            })"
            class="max-w-4xl mx-auto mt-12 space-y-6"
        >
            <template x-for="(event, index) in events" :key="index">
                <article
                    x-show="event.show"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-x-8"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="flex flex-col sm:flex-row gap-6 bg-white p-6 rounded-xl shadow-soft hover:shadow-medium transition-all duration-300 hover:translate-x-2 border-l-4 border-oxossi"
                >
                    <!-- Date Badge -->
                    <div class="flex-shrink-0 w-full sm:w-20 h-20 bg-oxossi text-white rounded-lg flex flex-col items-center justify-center">
                        <span class="text-3xl font-bold leading-none" x-text="event.day"></span>
                        <span class="text-xs font-semibold uppercase mt-1" x-text="event.month"></span>
                    </div>

                    <!-- Event Info -->
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 font-sans" x-text="event.title"></h3>
                        <p class="text-ogum font-semibold mb-3" x-text="event.time"></p>
                        <p class="text-gray-600 leading-relaxed" x-text="event.description"></p>
                    </div>
                </article>
            </template>
        </div>
    </div>
</section>
@endif
