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
                <input type="checkbox" id="fav" class="eats-filter-checkbox">
                <label for="fav">Favourites Only</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="non_fav" class="eats-filter-checkbox">
                <label for="non_fav">Non-Favourites Only</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Type</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="food_only" class="eats-filter-checkbox">
                <label for="food_only">Food Only</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="drinks_only" class="eats-filter-checkbox">
                <label for="drinks_only">Drinks Only</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Cuisine</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="indonesian" class="eats-filter-checkbox">
                <label for="indonesian">Indonesian</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="western" class="eats-filter-checkbox">
                <label for="western">Western</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="japanese" class="eats-filter-checkbox">
                <label for="japanese">Japanese</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="chinese" class="eats-filter-checkbox">
                <label for="chinese">Chinese</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="other" class="eats-filter-checkbox">
                <label for="other">Other</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Price Range</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="under_price" class="eats-filter-checkbox">
                <label for="under_price">&lt;Rp10,000</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="thirty_price" class="eats-filter-checkbox">
                <label for="thirty_price">Rp10,000 - Rp30,0000</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="sixty_price" class="eats-filter-checkbox">
                <label for="sixty_price">Rp30,000 - Rp60,0000</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="over_price" class="eats-filter-checkbox">
                <label for="over_price">&gt;Rp60,000</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Rating</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="five-rating" class="eats-filter-checkbox">
                <label for="five-rating">5</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="four_rating" class="eats-filter-checkbox">
                <label for="four_rating">4.0 - 4.9</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="three_rating" class="eats-filter-checkbox">
                <label for="three_rating">3.0 - 3.9</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="two_rating" class="eats-filter-checkbox">
                <label for="two_rating">2.0 - 2.9</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="under_rating" class="eats-filter-checkbox">
                <label for="under_rating">&lt;2.0</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Payment Options</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="cash" class="eats-filter-checkbox">
                <label for="cash">Cash</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="credit" class="eats-filter-checkbox">
                <label for="credit">Credit Card</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="debit" class="eats-filter-checkbox">
                <label for="debit">Debit Card</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="mobile" class="eats-filter-checkbox">
                <label for="mobile">Mobile Payment</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Special Features</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="halal" class="eats-filter-checkbox">
                <label for="halal">Halal</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="nonhalal" class="eats-filter-checkbox">
                <label for="nonhalal">Non-Halal</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="takeaway" class="eats-filter-checkbox">
                <label for="takeaway">Takeaway Available</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="indoor" class="eats-filter-checkbox">
                <label for="indoor">Indoor Seating</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="outdoor" class="eats-filter-checkbox">
                <label for="outdoor">Outdoor Seating</label>
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