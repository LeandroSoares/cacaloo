@props(['active'])

@php
$baseClasses = 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out';

// Determina se estamos usando o layout admin/sysadmin ou o layout padrão
$isAdmin = request()->routeIs('admin.*');
$isSysAdmin = request()->routeIs('sysadmin.*');

if ($isAdmin) {
    $classes = ($active ?? false)
        ? $baseClasses . ' border-blue-300 text-white focus:outline-none focus:border-blue-300'
        : $baseClasses . ' border-transparent text-blue-100 hover:text-white hover:border-blue-300 focus:outline-none focus:text-white focus:border-blue-300';
} elseif ($isSysAdmin) {
    $classes = ($active ?? false)
        ? $baseClasses . ' border-purple-300 text-white focus:outline-none focus:border-purple-300'
        : $baseClasses . ' border-transparent text-purple-100 hover:text-white hover:border-purple-300 focus:outline-none focus:text-white focus:border-purple-300';
} else {
    $classes = ($active ?? false)
        ? $baseClasses . ' border-indigo-400 text-gray-900 focus:outline-none focus:border-indigo-700'
        : $baseClasses . ' border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300';
}
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
