<?php $__env->startSection('title', 'Your Page Title'); ?>

<?php $__env->startSection('content'); ?>
<div class="eats-search-container">
    <p>5 Results found</p>
    <div class="eats-search-bar">
        <div class="eats-search-form">
            <img src="<?php echo e(asset('images/search.svg')); ?>" alt="Search Icon" class="eats-search-icon">
            <input type="text" placeholder="What you are looking for...">
        </div>
        <button type="submit" class="eats-search-submit">Search</button>
    </div>
</div>
<div class="eats-container">
    <div class="eats-filter-container">
        <h3>Filters</h3>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Type</h3>
            <div class="eats-filter-pack">
                <button class="eats-filter-button"></button>
                <h3>Restaurant</h3>
            </div>
            <div class="eats-filter-pack">
                <button class="eats-filter-button"></button>
                <h3>Café</h3>
            </div>
            <div class="eats-filter-pack">
                <button class="eats-filter-button"></button>
                <h3>Stall/Kiosk</h3>
            </div>
            <div class="eats-filter-pack">
                <button class="eats-filter-button"></button>
                <h3>Beverage</h3>
            </div>
            <div class="eats-filter-pack">
                <button class="eats-filter-button"></button>
                <h3>Buffet</h3>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Cuisine</h3>
            <div class="eats-filter-pack">
                <button class="eats-filter-button"></button>
                <h3>Indonesian</h3>
            </div>
            <div class="eats-filter-pack">
                <button class="eats-filter-button"></button>
                <h3>Western</h3>
            </div>
            <div class="eats-filter-pack">
                <button class="eats-filter-button"></button>
                <h3>Japanese</h3>
            </div>
            <div class="eats-filter-pack">
                <button class="eats-filter-button"></button>
                <h3>Chinese</h3>
            </div>
            <div class="eats-filter-pack">
                <button class="eats-filter-button"></button>
                <h3>Italian</h3>
            </div>
            <div class="eats-filter-pack">
                <button class="eats-filter-button"></button>
                <h3>Middle Eastern</h3>
            </div>
        </div>
    </div>
    <div class="eats-results-container">
        <div class="eats-cards-container">
            <div class="eats-card-image">
                <button class="eats-card-heart-button" aria-label="Add to favorites">
                    <img src="<?php echo e(asset('images/heart.svg')); ?>" alt="Heart Icon" class="eats-card-heart-icon">
                </button>
            </div>
            <div class="eats-card-content">
                <div class="eats-card-name-rating">
                    <h1>Solaria - Mal Ciputra</h1>
                    <div class="eats-card-rating">
                        <img src="<?php echo e(asset('images/star.svg')); ?>" alt="Star Icon" class="eats-card-star-icon">
                        <h3>2.5(176)
                    </div>
                </div>
                <p>Rp16,000 - Rp44,999
                <h2>Mall Ciputra Jakarta, Lantai 5</h2>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ivand\Documents\College\Projects\Tarumaeats\resources\views/eats.blade.php ENDPATH**/ ?>