

<?php $__env->startSection('title', 'Your Page Title'); ?>

<?php $__env->startSection('content'); ?>
    <div class="search-container">
        <form action="/search" method="GET">
            <input type="text" name="query" placeholder="Search">
            <button type="submit">Search</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ivand\Documents\College\Projects\Tarumaeats\resources\views/view.blade.php ENDPATH**/ ?>