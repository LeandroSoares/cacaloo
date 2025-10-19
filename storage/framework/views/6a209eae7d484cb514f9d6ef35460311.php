<div class="p-6 bg-white rounded-lg shadow-md mb-8 border border-gray-200">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Cruz de Força</h2>
    <form wire:submit.prevent="save" class="space-y-6">
        <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="top" class="block text-sm font-medium text-gray-700">Alto</label>
                <input type="text" id="top" wire:model="top" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['top'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
            <div>
                <label for="bottom" class="block text-sm font-medium text-gray-700">Embaixo</label>
                <input type="text" id="bottom" wire:model="bottom" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['bottom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
            <div>
                <label for="left" class="block text-sm font-medium text-gray-700">Esquerdo</label>
                <input type="text" id="left" wire:model="left" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['left'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
            <div>
                <label for="right" class="block text-sm font-medium text-gray-700">Direito</label>
                <input type="text" id="right" wire:model="right" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['right'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">Salvar Cruz de Força</button>
        </div>
    </form>
</div>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/livewire/force-cross-form.blade.php ENDPATH**/ ?>