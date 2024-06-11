<?php $__env->startSection('title', 'Eats'); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('eats.filter')); ?>">
        <?php echo csrf_field(); ?>
        <div class="eats-search-container">
            <p><?php echo e($listings->count()); ?> Results found</p>
            <div class="eats-search-bar">
                <div class="eats-search-form">
                    <img src="<?php echo e(asset('images/search.svg')); ?>" alt="Search Icon" class="eats-search-icon">
                    <input type="text" name="search" placeholder="What you are looking for..."
                        value="<?php echo e(request('search')); ?>">
                </div>
                <button type="submit" class="eats-search-submit">Search</button>
            </div>
        </div>
        <div class="eats-container">
            <div class="eats-filter-container">
                <h3>Filters</h3>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Campus</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="untar_satu" class="eats-filter-checkbox" name="campus[]" value="untar_satu"
                            <?php if(in_array('untar_satu', request('campus', []))): ?> checked <?php endif; ?>>
                        <label for="untar_satu">UNTAR 1</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="untar_dua" class="eats-filter-checkbox" name="campus[]"
                            value="untar_dua" <?php if(in_array('untar_dua', request('campus', []))): ?> checked <?php endif; ?>>
                        <label for="untar_dua">UNTAR 2</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Type</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="food_only" class="eats-filter-checkbox" name="type[]" value="food_only"
                            <?php if(in_array('food_only', request('type', []))): ?> checked <?php endif; ?>>
                        <label for="food_only">Food Only</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="drinks_only" class="eats-filter-checkbox" name="type[]"
                            value="drinks_only" <?php if(in_array('drinks_only', request('type', []))): ?> checked <?php endif; ?>>
                        <label for="drinks_only">Drinks Only</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Cuisine</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="indonesian" class="eats-filter-checkbox" name="cuisine[]"
                            value="indonesian" <?php if(in_array('indonesian', request('cuisine', []))): ?> checked <?php endif; ?>>
                        <label for="indonesian">Indonesian</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="western" class="eats-filter-checkbox" name="cuisine[]" value="western"
                            <?php if(in_array('western', request('cuisine', []))): ?> checked <?php endif; ?>>
                        <label for="western">Western</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="japanese" class="eats-filter-checkbox" value="japanese" name="cuisine[]"
                            <?php if(in_array('japanese', request('cuisine', []))): ?> checked <?php endif; ?>>
                        <label for="japanese">Japanese</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="chinese" class="eats-filter-checkbox" name="cuisine[]" value="chinese"
                            <?php if(in_array('chinese', request('cuisine', []))): ?> checked <?php endif; ?>>
                        <label for="chinese">Chinese</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="other" class="eats-filter-checkbox" name="cuisine[]" value="other"
                            <?php if(in_array('other', request('cuisine', []))): ?> checked <?php endif; ?>>
                        <label for="other">Other</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Price Range</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="under_price" class="eats-filter-checkbox" name="price_range[]"
                            value="under_price" <?php if(in_array('under_price', request('price_range', []))): ?> checked <?php endif; ?>>
                        <label for="under_price">&lt;Rp10,000</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="thirty_price" class="eats-filter-checkbox" name="price_range[]"
                            value="thirty_price" <?php if(in_array('thirty_price', request('price_range', []))): ?> checked <?php endif; ?>>
                        <label for="thirty_price">Rp10,000 - Rp30,000</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="sixty_price" class="eats-filter-checkbox" name="price_range[]"
                            value="sixty_price" <?php if(in_array('sixty_price', request('price_range', []))): ?> checked <?php endif; ?>>
                        <label for="sixty_price">Rp30,000 - Rp60,000</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="over_price" class="eats-filter-checkbox" name="price_range[]"
                            value="over_price" <?php if(in_array('over_price', request('price_range', []))): ?> checked <?php endif; ?>>
                        <label for="over_price">&gt;Rp60,000</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Payment Options</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="cash" class="eats-filter-checkbox" name="payment_options[]"
                            value="cash" <?php if(in_array('cash', request('payment_options', []))): ?> checked <?php endif; ?>>
                        <label for="cash">Cash</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="credit" class="eats-filter-checkbox" name="payment_options[]"
                            value="credit" <?php if(in_array('credit', request('payment_options', []))): ?> checked <?php endif; ?>>
                        <label for="credit">Credit Card</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="debit" class="eats-filter-checkbox" name="payment_options[]"
                            value="debit" <?php if(in_array('debit', request('payment_options', []))): ?> checked <?php endif; ?>>
                        <label for="debit">Debit Card</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="mobile" class="eats-filter-checkbox" name="payment_options[]"
                            value="mobile" <?php if(in_array('mobile', request('payment_options', []))): ?> checked <?php endif; ?>>
                        <label for="mobile">Mobile Payment</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Special Features</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="halal" class="eats-filter-checkbox" name="special_features[]"
                            value="halal" <?php if(in_array('halal', request('special_features', []))): ?> checked <?php endif; ?>>
                        <label for="halal">Halal</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="nonhalal" class="eats-filter-checkbox" name="special_features[]"
                            value="nonhalal" <?php if(in_array('nonhalal', request('special_features', []))): ?> checked <?php endif; ?>>
                        <label for="nonhalal">Non-Halal</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="takeaway" class="eats-filter-checkbox" name="special_features[]"
                            value="takeaway" <?php if(in_array('takeaway', request('special_features', []))): ?> checked <?php endif; ?>>
                        <label for="takeaway">Takeaway Available</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="indoor" class="eats-filter-checkbox" name="special_features[]"
                            value="indoor" <?php if(in_array('indoor', request('special_features', []))): ?> checked <?php endif; ?>>
                        <label for="indoor">Indoor Seating</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="outdoor" class="eats-filter-checkbox" name="special_features[]"
                            value="outdoor" <?php if(in_array('outdoor', request('special_features', []))): ?> checked <?php endif; ?>>
                        <label for="outdoor">Outdoor Seating</label>
                    </div>
                </div>
            </div>
            <div class="eats-results-container">
                <?php
                    if (!function_exists('PriceRangeDisplay')) {
                        function PriceRangeDisplay($price_range)
                        {
                            switch ($price_range) {
                                case 'under_price':
                                    return '&lt;Rp10,000';
                                case 'thirty_price':
                                    return 'Rp10,000 - Rp30,000';
                                case 'sixty_price':
                                    return 'Rp30,000 - Rp60,000';
                                case 'over_price':
                                    return '&gt;Rp60,000';
                                default:
                                    return 'Price range not specified';
                            }
                        }
                    }
                ?>
                <?php $__currentLoopData = $listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="eats-cards-container">
                        <div class="eats-card-image"
                            style="background-image: url('data:image/jpeg;base64,<?php echo e($listing->banner_image); ?>');">
                            <button class="eats-card-heart-button" aria-label="Add to favorites">
                                <img src="<?php echo e(asset('images/heart.svg')); ?>" alt="Heart Icon" class="eats-card-heart-icon">
                            </button>
                        </div>
                        <div class="eats-card-content">
                            <div class="eats-card-name-rating">
                                <h1><?php echo e($listing->location_name); ?></h1>
                                <div class="eats-card-rating">
                                    <img src="<?php echo e(asset('images/star.svg')); ?>" alt="Star Icon"
                                        class="eats-card-star-icon">
                                    <h3><?php echo e($listing->rating); ?> (<?php echo e($listing->reviews_count); ?>)</h3>
                                </div>
                            </div>
                            <p><?php echo PriceRangeDisplay($listing->price_range); ?></p>
                            <h2><?php echo e($listing->location_address); ?></h2>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ivand\Documents\College\Projects\Tarumaeats\resources\views/eats.blade.php ENDPATH**/ ?>