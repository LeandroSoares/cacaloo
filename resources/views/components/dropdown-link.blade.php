@php
// Determina se estamos usando o layout admin/sysadmin ou o layout padrão
$isAdmin = request()->routeIs('admin.*');
$isSysAdmin = request()->routeIs('sysadmin.*');

if ($isAdmin) {
    $classes = 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-blue-100 focus:outline-none focus:bg-blue-100 transition duration-150 ease-in-out';
} elseif ($isSysAdmin) {
    $classes = 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-purple-100 focus:outline-none focus:bg-purple-100 transition duration-150 ease-in-out';
} else {
    $classes = 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out';
}
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
