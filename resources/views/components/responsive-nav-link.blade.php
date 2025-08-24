@props(['active'])

@php
$baseClasses = 'block w-full ps-3 pe-4 py-2 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out';

// Determina se estamos usando o layout admin/sysadmin ou o layout padrão
$isAdmin = request()->routeIs('admin.*');
$isSysAdmin = request()->routeIs('sysadmin.*');

if ($isAdmin) {
    $classes = ($active ?? false)
        ? $baseClasses . ' border-blue-400 text-blue-700 bg-blue-50 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700'
        : $baseClasses . ' border-transparent text-gray-200 hover:text-white hover:bg-blue-700 hover:border-blue-300 focus:outline-none focus:text-white focus:bg-blue-700 focus:border-blue-300';
} elseif ($isSysAdmin) {
    $classes = ($active ?? false)
        ? $baseClasses . ' border-purple-400 text-purple-700 bg-purple-50 focus:outline-none focus:text-purple-800 focus:bg-purple-100 focus:border-purple-700'
        : $baseClasses . ' border-transparent text-gray-200 hover:text-white hover:bg-purple-700 hover:border-purple-300 focus:outline-none focus:text-white focus:bg-purple-700 focus:border-purple-300';
} else {
    $classes = ($active ?? false)
        ? $baseClasses . ' border-indigo-400 text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700'
        : $baseClasses . ' border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300';
}
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
