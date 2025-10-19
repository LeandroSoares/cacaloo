<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['homeContent' => null]));

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

foreach (array_filter((['homeContent' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Casa de Caridade Legião de Oxóssi e Ogum - Um espaço de acolhimento espiritual, caridade e desenvolvimento mediúnico">

    <title><?php echo e($title ?? 'Casa de Caridade Legião de Oxóssi e Ogum'); ?></title>

    <!-- Preconnect para fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <?php echo e($head ?? ''); ?>

</head>
<body class="font-body text-gray-900 antialiased">

    <!-- Skip to main content (acessibilidade) -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-oxossi text-white px-4 py-2 rounded-lg z-50">
        Pular para conteúdo principal
    </a>

    <!-- Header/Navegação -->
    <?php if($homeContent): ?>
        <?php if (isset($component)) { $__componentOriginale30b2855ee1e4ae30e50fcbbc76a33ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale30b2855ee1e4ae30e50fcbbc76a33ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.header','data' => ['sectionsVisibility' => $homeContent]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sections-visibility' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($homeContent)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale30b2855ee1e4ae30e50fcbbc76a33ff)): ?>
<?php $attributes = $__attributesOriginale30b2855ee1e4ae30e50fcbbc76a33ff; ?>
<?php unset($__attributesOriginale30b2855ee1e4ae30e50fcbbc76a33ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale30b2855ee1e4ae30e50fcbbc76a33ff)): ?>
<?php $component = $__componentOriginale30b2855ee1e4ae30e50fcbbc76a33ff; ?>
<?php unset($__componentOriginale30b2855ee1e4ae30e50fcbbc76a33ff); ?>
<?php endif; ?>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginale30b2855ee1e4ae30e50fcbbc76a33ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale30b2855ee1e4ae30e50fcbbc76a33ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale30b2855ee1e4ae30e50fcbbc76a33ff)): ?>
<?php $attributes = $__attributesOriginale30b2855ee1e4ae30e50fcbbc76a33ff; ?>
<?php unset($__attributesOriginale30b2855ee1e4ae30e50fcbbc76a33ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale30b2855ee1e4ae30e50fcbbc76a33ff)): ?>
<?php $component = $__componentOriginale30b2855ee1e4ae30e50fcbbc76a33ff; ?>
<?php unset($__componentOriginale30b2855ee1e4ae30e50fcbbc76a33ff); ?>
<?php endif; ?>
    <?php endif; ?>

    <!-- Main Content -->
    <main id="main-content">
        <?php echo e($slot); ?>

    </main>

    <!-- Footer -->
    <?php if (isset($component)) { $__componentOriginal4766510e0268a7a5917e77b146281554 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4766510e0268a7a5917e77b146281554 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4766510e0268a7a5917e77b146281554)): ?>
<?php $attributes = $__attributesOriginal4766510e0268a7a5917e77b146281554; ?>
<?php unset($__attributesOriginal4766510e0268a7a5917e77b146281554); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4766510e0268a7a5917e77b146281554)): ?>
<?php $component = $__componentOriginal4766510e0268a7a5917e77b146281554; ?>
<?php unset($__componentOriginal4766510e0268a7a5917e77b146281554); ?>
<?php endif; ?>

    <!-- Scripts adicionais -->
    <?php echo e($scripts ?? ''); ?>

</body>
</html>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/components/layout/app.blade.php ENDPATH**/ ?>