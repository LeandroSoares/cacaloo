@props([
    'variant' => 'primary', // primary, secondary, whatsapp
    'size' => 'md',         // sm, md, lg
    'href' => '#',
    'type' => 'link',       // link, button
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-semibold rounded-lg transition-all duration-300 focus-ring';

    $variants = [
        'primary' => 'bg-oxossi hover:bg-oxossi-dark text-white shadow-md hover:shadow-lg hover:-translate-y-0.5',
        'secondary' => 'bg-transparent border-2 border-white text-white hover:bg-white/10 shadow-md hover:shadow-lg hover:-translate-y-0.5',
        'whatsapp' => 'bg-green-500 hover:bg-green-600 text-white shadow-md hover:shadow-lg hover:-translate-y-0.5',
    ];

    $sizes = [
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-3 text-base',
        'lg' => 'px-8 py-4 text-lg',
    ];

    $classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if($type === 'link')
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
