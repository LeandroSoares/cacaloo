<section id="sobre" class="py-20 lg:py-32 bg-gray-50">
    <div class="container mx-auto px-4">

        <!-- Section Title -->
        <?php if (isset($component)) { $__componentOriginal02a170618cef57f8f8e8e7cbeca0353c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal02a170618cef57f8f8e8e7cbeca0353c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section-title','data' => ['title' => 'Sobre Nossa Casa','subtitle' => 'Conheça nossa história, missão e os Orixás que guiam nosso caminho']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Sobre Nossa Casa','subtitle' => 'Conheça nossa história, missão e os Orixás que guiam nosso caminho']); ?>
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
                cards: [
                    { show: false, delay: 0 },
                    { show: false, delay: 200 },
                    { show: false, delay: 400 }
                ]
            }"
            x-init="cards.forEach((card, i) => {
                setTimeout(() => card.show = true, card.delay);
            })"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12"
        >

            <!-- Card 1: História -->
            <div
                x-show="cards[0].show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['icon' => 'book','title' => 'Nossa História','text' => 'A Casa de Caridade Legião de Oxóssi e Ogum foi fundada com o propósito de oferecer um espaço de acolhimento espiritual, caridade e desenvolvimento mediúnico. Ao longo dos anos, temos servido à comunidade com dedicação e amor.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'book','title' => 'Nossa História','text' => 'A Casa de Caridade Legião de Oxóssi e Ogum foi fundada com o propósito de oferecer um espaço de acolhimento espiritual, caridade e desenvolvimento mediúnico. Ao longo dos anos, temos servido à comunidade com dedicação e amor.']); ?>
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

            <!-- Card 2: Missão -->
            <div
                x-show="cards[1].show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['icon' => 'heart','title' => 'Missão e Valores','text' => 'Nossa missão é promover a caridade, o amor ao próximo e o desenvolvimento espiritual através dos ensinamentos da Umbanda. Trabalhamos com fé, humildade e respeito às forças da natureza e aos Orixás.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'heart','title' => 'Missão e Valores','text' => 'Nossa missão é promover a caridade, o amor ao próximo e o desenvolvimento espiritual através dos ensinamentos da Umbanda. Trabalhamos com fé, humildade e respeito às forças da natureza e aos Orixás.']); ?>
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

            <!-- Card 3: Orixás -->
            <div
                x-show="cards[2].show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['icon' => 'star','title' => 'Oxóssi e Ogum','text' => 'Oxóssi, o caçador das matas, representa fartura e conhecimento. Ogum, o guerreiro, simboliza força e determinação. São nossos guias espirituais que nos auxiliam no caminho da evolução e da caridade.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'star','title' => 'Oxóssi e Ogum','text' => 'Oxóssi, o caçador das matas, representa fartura e conhecimento. Ogum, o guerreiro, simboliza força e determinação. São nossos guias espirituais que nos auxiliam no caminho da evolução e da caridade.']); ?>
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

        </div>
    </div>
</section>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/components/sections/about.blade.php ENDPATH**/ ?>