@props(['type' => 'submit', 'variant' => 'primary'])

@php
    $classes = match($variant) {
        'primary' => 'text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200',
        'secondary' => 'bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-1 rounded transition duration-200',
        default => 'text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200',
    };

    $primaryStyle = $variant === 'primary' ? 'background-color: var(--oxossi-main);' : '';
    $primaryHover = $variant === 'primary' ? 'onmouseover="this.style.backgroundColor=\'var(--oxossi-dark)\'" onmouseout="this.style.backgroundColor=\'var(--oxossi-main)\'"' : '';
@endphp

<button
    type="{{ $type }}"
    class="{{ $classes }}"
    style="{{ $primaryStyle }}"
    {!! $primaryHover !!}
    {{ $attributes }}
>
    {{ $slot }}
</button>
