<div class="page-container">
    <!-- Conditionally include the header only if the headerClass is not 'show-header' -->
    <?php if(empty($headerClass) || $headerClass !== 'show-header'): ?>
        <?php echo $__env->make('partials.header', ['class' => $headerClass ?? ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH C:\Users\ivand\Documents\College\Projects\Tarumaeats\resources\views/layouts/app.blade.php ENDPATH**/ ?>