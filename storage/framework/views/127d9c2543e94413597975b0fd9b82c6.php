<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['active']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['active']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<a <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php echo e($slot); ?>

</a>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/components/responsive-nav-link.blade.php ENDPATH**/ ?>