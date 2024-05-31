<?php $__env->startSection('title', 'Your Page Title'); ?>

<?php $__env->startSection('content'); ?>
    <div class="search-container">
        <p>5 Results found</p>
        <div class="search-bar">
            <div class="search-form">
                <img src="<?php echo e(asset('images/search.svg')); ?>" alt="Search Icon" class="search-icon">
                <input type="text" placeholder="What you are looking for...">
            </div>
            <button type="submit" class="search-submit">Search</button>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ivand\Documents\College\Projects\Tarumaeats\resources\views/eats.blade.php ENDPATH**/ ?>