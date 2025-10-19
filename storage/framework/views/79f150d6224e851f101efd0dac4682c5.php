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
$title = $content['title'] ?? 'Giras e Eventos';
$subtitle = $content['subtitle'] ?? 'Confira nossa programação e participe conosco';
$events = $content['events'] ?? [];
$isVisible = $content['is_visible'] ?? true;
?>

<?php if($isVisible): ?>
<section id="eventos" class="py-20 lg:py-32 bg-white">
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

        <!-- Events List -->
        <div
            x-data="{
                events: [
                    {
                        day: '25',
                        month: 'OUT',
                        title: 'Gira de Caboclos',
                        time: 'Sexta-feira às 20h00',
                        description: 'Trabalho espiritual com os Caboclos da mata, entidades de Oxóssi que trazem mensagens de força e sabedoria.',
                        show: false
                    },
                    {
                        day: '28',
                        month: 'OUT',
                        title: 'Gira de Pretos-Velhos',
                        time: 'Segunda-feira às 20h00',
                        description: 'Trabalho de caridade e aconselhamento com os sábios Pretos-Velhos, que trazem paz e conforto espiritual.',
                        show: false
                    },
                    {
                        day: '01',
                        month: 'NOV',
                        title: 'Gira de Exú',
                        time: 'Sexta-feira às 20h00',
                        description: 'Trabalho de limpeza espiritual e abertura de caminhos com os guardiões Exús.',
                        show: false
                    }
                ]
            }"
            x-init="events.forEach((event, i) => {
                setTimeout(() => event.show = true, i * 150);
            })"
            class="max-w-4xl mx-auto mt-12 space-y-6"
        >
            <template x-for="(event, index) in events" :key="index">
                <article
                    x-show="event.show"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-x-8"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="flex flex-col sm:flex-row gap-6 bg-white p-6 rounded-xl shadow-soft hover:shadow-medium transition-all duration-300 hover:translate-x-2 border-l-4 border-oxossi"
                >
                    <!-- Date Badge -->
                    <div class="flex-shrink-0 w-full sm:w-20 h-20 bg-oxossi text-white rounded-lg flex flex-col items-center justify-center">
                        <span class="text-3xl font-bold leading-none" x-text="event.day"></span>
                        <span class="text-xs font-semibold uppercase mt-1" x-text="event.month"></span>
                    </div>

                    <!-- Event Info -->
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 font-sans" x-text="event.title"></h3>
                        <p class="text-ogum font-semibold mb-3" x-text="event.time"></p>
                        <p class="text-gray-600 leading-relaxed" x-text="event.description"></p>
                    </div>
                </article>
            </template>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/components/sections/events.blade.php ENDPATH**/ ?>