@props(['show' => true, 'type' => 'success'])

@php
    $classes = match($type) {
        'success' => 'text-green-800 bg-green-50 border-green-200',
        'error' => 'text-red-800 bg-red-50 border-red-200',
        'info' => 'text-blue-800 bg-blue-50 border-blue-200',
        default => 'text-green-800 bg-green-50 border-green-200',
    };
@endphp

<div
    x-data="{ show: @js($show) }"
    x-init="if(show) setTimeout(() => show = false, 5000)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-95"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-95"
    class="p-4 mb-4 text-sm rounded-lg border {{ $classes }}"
>
    {{ $slot }}
</div>
