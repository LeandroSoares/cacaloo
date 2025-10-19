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
$title = $content['title'] ?? 'Entre em Contato';
$subtitle = $content['subtitle'] ?? 'Estamos aqui para atendê-lo com carinho e dedicação';
$contentText = $content['content'] ?? '';
$isVisible = $content['is_visible'] ?? true;
?>

<?php if($isVisible): ?>
<section id="contato" class="py-20 lg:py-32 bg-gray-50">
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

        <!-- Contact Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mt-12 max-w-6xl mx-auto">

            <!-- Informações de Contato -->
            <div class="space-y-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 pb-3 border-b-4 border-oxossi font-sans">
                    Informações de Contato
                </h3>

                <!-- Endereço -->
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 text-oxossi">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2">Endereço</h4>
                        <p class="text-gray-600 leading-relaxed">
                            <?php echo e(config('centro.endereco.rua')); ?><br>
                            <?php echo e(config('centro.endereco.cidade')); ?> - <?php echo e(config('centro.endereco.estado')); ?><br>
                            CEP: <?php echo e(config('centro.endereco.cep')); ?>

                        </p>
                    </div>
                </div>

                <!-- Telefone -->
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 text-oxossi">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2">Telefone</h4>
                        <a href="tel:<?php echo e(config('centro.contato.telefone')); ?>" class="text-gray-600 hover:text-oxossi transition-colors">
                            <?php echo e(config('centro.contato.telefone')); ?>

                        </a>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 text-oxossi">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2">E-mail</h4>
                        <a href="mailto:<?php echo e(config('centro.contato.email')); ?>" class="text-gray-600 hover:text-oxossi transition-colors break-all">
                            <?php echo e(config('centro.contato.email')); ?>

                        </a>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="bg-green-50 p-6 rounded-lg border-2 border-green-200">
                    <div class="flex gap-4 items-start">
                        <div class="flex-shrink-0 w-12 h-12 text-green-600">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-lg mb-3 text-green-900">WhatsApp</h4>
                            <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['href' => ''.e(config('centro.contato.whatsapp')).'','variant' => 'whatsapp','size' => 'md','type' => 'link','target' => '_blank','rel' => 'noopener noreferrer']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(config('centro.contato.whatsapp')).'','variant' => 'whatsapp','size' => 'md','type' => 'link','target' => '_blank','rel' => 'noopener noreferrer']); ?>
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                                Fale Conosco pelo WhatsApp
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
                        </div>
                    </div>
                </div>
            </div>

            <!-- Horários de Funcionamento -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6 pb-3 border-b-4 border-oxossi font-sans">
                    Horários de Funcionamento
                </h3>

                <div class="bg-white rounded-lg shadow-soft overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-oxossi text-white">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Dia</th>
                                <th class="px-6 py-4 text-left font-semibold">Horário</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__currentLoopData = config('centro.horarios'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dia => $horario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-900"><?php echo e($dia); ?></td>
                                <td class="px-6 py-4 <?php echo e($horario === 'Fechado' ? 'text-gray-400' : 'text-gray-600'); ?>"><?php echo e($horario); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-gold rounded-lg">
                    <p class="text-sm text-gray-700 leading-relaxed">
                        <strong class="text-gray-900">Observação:</strong> Em datas especiais e festas de Orixás,
                        podem haver alterações. Consulte pelo WhatsApp.
                    </p>
                </div>

                <?php if($contentText): ?>
                <div class="mt-6 p-4 bg-oxossi/10 border-l-4 border-oxossi rounded-lg">
                    <p class="text-gray-700 leading-relaxed"><?php echo e($contentText); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/components/sections/contact.blade.php ENDPATH**/ ?>