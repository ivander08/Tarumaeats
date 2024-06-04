<?php $__env->startSection('title', 'Eats'); ?>

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
            <h3>Favourite</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-fav" class="eats-filter-checkbox">
                <label for="filter-fav">Favourites Only</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-nonfav" class="eats-filter-checkbox">
                <label for="filter-nonfav">Non-Favourites Only</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Type</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-food-type" class="eats-filter-checkbox">
                <label for="filter-food-type">Food Only</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-drink-type" class="eats-filter-checkbox">
                <label for="filter-drink-type">Drinks Only</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Cuisine</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-indonesian-cuisine" class="eats-filter-checkbox">
                <label for="filter-indonesian-cuisine">Indonesian</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-western-cuisine" class="eats-filter-checkbox">
                <label for="filter-western-cuisine">Western</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-japanese-cuisine" class="eats-filter-checkbox">
                <label for="filter-japanese-cuisine">Japanese</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-chinese-cuisine" class="eats-filter-checkbox">
                <label for="filter-chinese-cuisine">Chinese</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-other-cuisine" class="eats-filter-checkbox">
                <label for="filter-other-cuisine">Other</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Price Range</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-under-price" class="eats-filter-checkbox">
                <label for="filter-under-price">&lt;Rp10,000</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-thirty-price" class="eats-filter-checkbox">
                <label for="filter-thirty-price">Rp10,000 - Rp30,0000</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-sixty-price" class="eats-filter-checkbox">
                <label for="filter-sixty-price">Rp30,000 - Rp60,0000</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-over-price" class="eats-filter-checkbox">
                <label for="filter-over-price">&gt;Rp60,000</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Rating</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-five-rating" class="eats-filter-checkbox">
                <label for="filter-five-rating">5</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-four-rating" class="eats-filter-checkbox">
                <label for="filter-four-rating">4.0 - 4.9</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-three-rating" class="eats-filter-checkbox">
                <label for="filter-three-rating">3.0 - 3.9</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-two-rating" class="eats-filter-checkbox">
                <label for="filter-two-rating">2.0 - 2.9</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-under-rating" class="eats-filter-checkbox">
                <label for="filter-under-rating">&lt;2.0</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Payment Options</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-cash-option" class="eats-filter-checkbox">
                <label for="filter-cash-option">Cash</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-credit-option" class="eats-filter-checkbox">
                <label for="filter-credit-option">Credit Card</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-debit-option" class="eats-filter-checkbox">
                <label for="filter-debit-option">Debit Card</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-mobile-option" class="eats-filter-checkbox">
                <label for="filter-mobile-option">Mobile Payment</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Special Features</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-halal-special" class="eats-filter-checkbox">
                <label for="filter-halal-special">Halal</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-nonhalal-special" class="eats-filter-checkbox">
                <label for="filter-nonhalal-special">Non-Halal</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-takeaway-special" class="eats-filter-checkbox">
                <label for="filter-takeaway-special">Takeaway Available</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-indoor-special" class="eats-filter-checkbox">
                <label for="filter-indoor-special">Indoor Seating</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="filter-outdoor-special" class="eats-filter-checkbox">
                <label for="filter-outdoor-special">Outdoor Seating</label>
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