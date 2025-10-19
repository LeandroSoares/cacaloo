<?php if (isset($component)) { $__componentOriginalcf7e1d4949dbd350ec830409f7127ebc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf7e1d4949dbd350ec830409f7127ebc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.app','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> 
        Home - Casa de Caridade Legião de Oxóssi e Ogum
     <?php $__env->endSlot(); ?>

    <!-- Hero Section -->
    <?php if (isset($component)) { $__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.hero','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764)): ?>
<?php $attributes = $__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764; ?>
<?php unset($__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764)): ?>
<?php $component = $__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764; ?>
<?php unset($__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764); ?>
<?php endif; ?>

    <!-- Sobre Section -->
    <?php if (isset($component)) { $__componentOriginalf7639b4297590aab4e2fa9c6ac29c451 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf7639b4297590aab4e2fa9c6ac29c451 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.about','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.about'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf7639b4297590aab4e2fa9c6ac29c451)): ?>
<?php $attributes = $__attributesOriginalf7639b4297590aab4e2fa9c6ac29c451; ?>
<?php unset($__attributesOriginalf7639b4297590aab4e2fa9c6ac29c451); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf7639b4297590aab4e2fa9c6ac29c451)): ?>
<?php $component = $__componentOriginalf7639b4297590aab4e2fa9c6ac29c451; ?>
<?php unset($__componentOriginalf7639b4297590aab4e2fa9c6ac29c451); ?>
<?php endif; ?>

    <!-- Eventos Section -->
    <?php if (isset($component)) { $__componentOriginal3dcf9ccda5a0b058aff25f8778e33817 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3dcf9ccda5a0b058aff25f8778e33817 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.events','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.events'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3dcf9ccda5a0b058aff25f8778e33817)): ?>
<?php $attributes = $__attributesOriginal3dcf9ccda5a0b058aff25f8778e33817; ?>
<?php unset($__attributesOriginal3dcf9ccda5a0b058aff25f8778e33817); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3dcf9ccda5a0b058aff25f8778e33817)): ?>
<?php $component = $__componentOriginal3dcf9ccda5a0b058aff25f8778e33817; ?>
<?php unset($__componentOriginal3dcf9ccda5a0b058aff25f8778e33817); ?>
<?php endif; ?>

    <!-- Contato Section -->
    <?php if (isset($component)) { $__componentOriginal62de9fc3ebe431a0d746cd50eda6c97f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62de9fc3ebe431a0d746cd50eda6c97f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.contact','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.contact'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal62de9fc3ebe431a0d746cd50eda6c97f)): ?>
<?php $attributes = $__attributesOriginal62de9fc3ebe431a0d746cd50eda6c97f; ?>
<?php unset($__attributesOriginal62de9fc3ebe431a0d746cd50eda6c97f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal62de9fc3ebe431a0d746cd50eda6c97f)): ?>
<?php $component = $__componentOriginal62de9fc3ebe431a0d746cd50eda6c97f; ?>
<?php unset($__componentOriginal62de9fc3ebe431a0d746cd50eda6c97f); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcf7e1d4949dbd350ec830409f7127ebc)): ?>
<?php $attributes = $__attributesOriginalcf7e1d4949dbd350ec830409f7127ebc; ?>
<?php unset($__attributesOriginalcf7e1d4949dbd350ec830409f7127ebc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcf7e1d4949dbd350ec830409f7127ebc)): ?>
<?php $component = $__componentOriginalcf7e1d4949dbd350ec830409f7127ebc; ?>
<?php unset($__componentOriginalcf7e1d4949dbd350ec830409f7127ebc); ?>
<?php endif; ?>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/home.blade.php ENDPATH**/ ?>