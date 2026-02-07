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

        <div class="max-w-4xl mx-auto mt-12 space-y-6">
            @forelse($events as $event)
                @php
                    // Parse da data para exibir dia e mês separados
                    $date = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $event['event_date']);
                    $day = $date->format('d');
                    $month = strtoupper($date->translatedFormat('M'));
                @endphp
                <article
                    x-data="{ show: false }"
                    x-init="setTimeout(() => show = true, {{ $loop->index * 150 }})"
                    x-show="show"
                    x-cloak
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-x-8"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="flex flex-col sm:flex-row gap-6 bg-white p-6 rounded-xl shadow-soft hover:shadow-medium transition-all duration-300 hover:translate-x-2 border-l-4 border-oxossi"
                >
                    <!-- Date Badge -->
                    <div class="flex-shrink-0 w-full sm:w-20 h-20 bg-oxossi text-white rounded-lg flex flex-col items-center justify-center">
                        <span class="text-3xl font-bold leading-none">{{ $day }}</span>
                        <span class="text-xs font-semibold uppercase mt-1">{{ $month }}</span>
                    </div>

                    <!-- Event Info -->
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 font-sans">{{ $event['title'] }}</h3>
                        <p class="text-ogum font-semibold mb-3">
                            {{ $date->translatedFormat('l') }} às {{ $date->format('H:i') }}
                            @if(!empty($event['location']))
                                <span class="text-gray-500 font-normal text-sm ml-2">• {{ $event['location'] }}</span>
                            @endif
                        </p>
                        <p class="text-gray-600 leading-relaxed">{{ $event['description'] }}</p>
                    </div>
                </article>
            @empty
                <div class="text-center py-12 bg-gray-50 rounded-lg">
                    <p class="text-gray-500">Nenhum evento programado para os próximos dias.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endif
