<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'primary', // primary, secondary, whatsapp
    'size' => 'md',         // sm, md, lg
    'href' => '#',
    'type' => 'link',       // link, button
]));

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

foreach (array_filter(([
    'variant' => 'primary', // primary, secondary, whatsapp
    'size' => 'md',         // sm, md, lg
    'href' => '#',
    'type' => 'link',       // link, button
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<?php if($type === 'link'): ?>
    <a href="<?php echo e($href); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php echo e($slot); ?>

    </button>
<?php endif; ?>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/components/ui/button.blade.php ENDPATH**/ ?>