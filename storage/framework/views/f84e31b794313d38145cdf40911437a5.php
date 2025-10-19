<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['content' => [], 'sectionsVisibility' => []]));

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

foreach (array_filter((['content' => [], 'sectionsVisibility' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$titleLine1 = $content['title_line1'] ?? 'Casa de Caridade';
$titleLine2 = $content['title_line2'] ?? 'Legião de Oxóssi e Ogum';
$subtitle = $content['subtitle'] ?? 'Um espaço de acolhimento, caridade e conexão espiritual dedicado aos Orixás Oxóssi e Ogum';
$backgroundImage = $content['background_image'] ?? asset('images/floresta1.jpg');
$backgroundColor = $content['background_color'] ?? '#2E7D32';
$isVisible = $content['is_visible'] ?? true;

// Verificar visibilidade das seções para os botões
$aboutVisible = $sectionsVisibility['about']['is_visible'] ?? true;
$contactVisible = $sectionsVisibility['contact']['is_visible'] ?? true;
?>

<?php if($isVisible): ?>
<section id="inicio" class="relative min-h-screen flex items-center justify-center overflow-hidden">

    <!-- Background Image com Parallax -->
    <div class="absolute inset-0 z-0">
        <img
            src="<?php echo e($backgroundImage); ?>"
            alt=""
            role="presentation"
            class="w-full h-full object-cover object-center"
            loading="eager"
        >
        <!-- Overlay Gradient -->
        <div class="absolute inset-0 hero-overlay" style="background-color: <?php echo e($backgroundColor); ?>66;"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 py-20 text-center">

        <!-- Logo -->
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 100)"
            x-show="show"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="mb-8"
        >
            <img
                src="<?php echo e(asset('images/logo600x600.png')); ?>"
                alt="Logo Casa de Caridade Legião de Oxóssi e Ogum"
                class="w-32 h-32 lg:w-40 lg:h-40 mx-auto rounded-full ring-4 ring-gold shadow-2xl"
            >
        </div>

        <!-- Title -->
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 300)"
            x-show="show"
            x-transition:enter="transition ease-out duration-700 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="mb-6"
        >
            <?php if(!empty($titleLine1)): ?>
            <h1 class="font-sans font-bold text-white
                       text-4xl sm:text-5xl lg:text-6xl xl:text-7xl
                       leading-tight drop-shadow-2xl">
                <?php echo nl2br(e($titleLine1)); ?>

            </h1>
            <?php endif; ?>

            <?php if(!empty($titleLine2)): ?>
            <h1 class="font-sans font-bold text-gold
                       text-4xl sm:text-5xl lg:text-6xl xl:text-7xl
                       leading-tight drop-shadow-2xl">
                <?php echo nl2br(e($titleLine2)); ?>

            </h1>
            <?php endif; ?>
        </div>

        <!-- Subtitle -->
        <p
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 500)"
            x-show="show"
            x-transition:enter="transition ease-out duration-700 delay-300"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="text-white text-lg sm:text-xl lg:text-2xl mb-10 max-w-3xl mx-auto
                   leading-relaxed drop-shadow-lg"
        >
            <?php echo e($subtitle); ?>

        </p>

        <!-- CTAs -->
        <?php if($aboutVisible || $contactVisible): ?>
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 700)"
            x-show="show"
            x-transition:enter="transition ease-out duration-700 delay-500"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="flex flex-col sm:flex-row gap-4 justify-center items-center"
        >
            <?php if($aboutVisible): ?>
            <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['href' => '#sobre','variant' => 'primary','size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#sobre','variant' => 'primary','size' => 'lg']); ?>
                Saiba Mais
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if($contactVisible): ?>
            <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['href' => '#contato','variant' => 'secondary','size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#contato','variant' => 'secondary','size' => 'lg']); ?>
                Entre em Contato
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/components/sections/hero.blade.php ENDPATH**/ ?>