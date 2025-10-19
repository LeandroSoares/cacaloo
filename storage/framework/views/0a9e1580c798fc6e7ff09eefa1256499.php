<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => '',
    'subtitle' => '',
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
    'title' => '',
    'subtitle' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="text-center mb-12">
    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4 font-sans">
        <?php echo e($title); ?>

    </h2>
    <?php if($subtitle): ?>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
            <?php echo e($subtitle); ?>

        </p>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/components/ui/section-title.blade.php ENDPATH**/ ?>