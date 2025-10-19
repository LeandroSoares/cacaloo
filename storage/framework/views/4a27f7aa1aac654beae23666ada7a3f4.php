<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-lg font-semibold text-gray-800">Último Templo</h2>
    <form wire:submit="save" class="space-y-6">
        <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            <?php echo e(session('message')); ?>

        </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nome do Templo</label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Endereço</label>
                <input type="text" id="address" wire:model="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label for="leader_name" class="block text-sm font-medium text-gray-700">Nome do Líder</label>
                <input type="text" id="leader_name" wire:model="leader_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['leader_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label for="function" class="block text-sm font-medium text-gray-700">Função Desempenhada</label>
                <input type="text" id="function" wire:model="function" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['function'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div class="md:col-span-2">
                <label for="exit_reason" class="block text-sm font-medium text-gray-700">Motivo da Saída</label>
                <textarea id="exit_reason" wire:model="exit_reason" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['exit_reason'];
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
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Salvar
            </button>
        </div>
    </form>
</div>
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/livewire/last-temple-form.blade.php ENDPATH**/ ?>