@props([
    'title' => '',
    'subtitle' => '',
])

<div class="text-center mb-12">
    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4 font-sans">
        {{ $title }}
    </h2>
    @if($subtitle)
        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
            {{ $subtitle }}
        </p>
    @endif
</div>
