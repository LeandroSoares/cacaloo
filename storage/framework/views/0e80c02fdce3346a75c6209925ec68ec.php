<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-lg font-semibold text-gray-800">Guias de Trabalho</h2>
    <form wire:submit="save" class="space-y-6">
        <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            <?php echo e(session('message')); ?>

        </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Caboclo</label>
                <input type="text" wire:model="caboclo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['caboclo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Cabocla</label>
                <input type="text" wire:model="cabocla" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['cabocla'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Ogum</label>
                <input type="text" wire:model="ogum" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['ogum'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Xangô</label>
                <input type="text" wire:model="xango" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['xango'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Baiano</label>
                <input type="text" wire:model="baiano" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['baiano'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Baiana</label>
                <input type="text" wire:model="baiana" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['baiana'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Preto Velho</label>
                <input type="text" wire:model="preto_velho" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['preto_velho'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Preta Velha</label>
                <input type="text" wire:model="preta_velha" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['preta_velha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Marinheiro</label>
                <input type="text" wire:model="marinheiro" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['marinheiro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Erê</label>
                <input type="text" wire:model="ere" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['ere'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Exu</label>
                <input type="text" wire:model="exu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['exu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Pombagira</label>
                <input type="text" wire:model="pombagira" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['pombagira'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Exu Mirim</label>
                <input type="text" wire:model="exu_mirim" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['exu_mirim'];
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
<?php /**PATH C:\Users\leand\projects\cacaloo\resources\views/livewire/work-guide-form.blade.php ENDPATH**/ ?>