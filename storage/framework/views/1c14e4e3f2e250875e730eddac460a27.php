<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['content' => []]));

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

foreach (array_filter((['content' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$title = $content['title'] ?? 'Sobre Nossa Casa';
$subtitle = $content['subtitle'] ?? 'Conheça nossa história, missão e os Orixás que guiam nosso caminho';
$cards = $content['cards'] ?? [
    ['title' => 'Nossa História', 'content' => 'Conheça nossa trajetória espiritual', 'icon' => 'book'],
    ['title' => 'Nossa Missão', 'content' => 'Promover caridade e evolução espiritual', 'icon' => 'hands'],
    ['title' => 'Nossos Valores', 'content' => 'Fé, caridade e amor ao próximo', 'icon' => 'heart']
];
$isVisible = $content['is_visible'] ?? true;
?>

<?php if($isVisible): ?>
<section id="sobre" class="py-20 lg:py-32 bg-gray-50">
    <div class="container mx-auto px-4">

        <!-- Section Title -->
        <?php if (isset($component)) { $__componentOriginal02a170618cef57f8f8e8e7cbeca0353c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal02a170618cef57f8f8e8e7cbeca0353c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section-title','data' => ['title' => $title,'subtitle' => $subtitle]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subtitle)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal02a170618cef57f8f8e8e7cbeca0353c)): ?>
<?php $attributes = $__attributesOriginal02a170618cef57f8f8e8e7cbeca0353c; ?>
<?php unset($__attributesOriginal02a170618cef57f8f8e8e7cbeca0353c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal02a170618cef57f8f8e8e7cbeca0353c)): ?>
<?php $component = $__componentOriginal02a170618cef57f8f8e8e7cbeca0353c; ?>
<?php unset($__componentOriginal02a170618cef57f8f8e8e7cbeca0353c); ?>
<?php endif; ?>

        <!-- Cards Grid -->
        <div
            x-data="{
                cards: <?php echo \Illuminate\Support\Js::from(array_fill(0, count($cards), ['show' => false]))->toHtml() ?>
            }"
            x-init="cards.forEach((card, i) => {
                setTimeout(() => card.show = true, i * 200);
            })"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12"
        >

            <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!-- Card <?php echo e($index + 1); ?>: <?php echo e($card['title']); ?> -->
            <div
                x-show="cards[<?php echo e($index); ?>].show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['icon' => $card['icon'] ?? 'star','title' => $card['title'],'text' => $card['content']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['icon'] ?? 'star'),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['title']),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['content'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $attributes = $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $component = $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/components/sections/about.blade.php ENDPATH**/ ?>