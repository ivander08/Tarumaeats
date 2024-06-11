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
            <form method="POST" action="<?php echo e(route('eats.filter')); ?>">
                <?php echo csrf_field(); ?>
                <div class="eats-filter-pack-container">
                    <h3>Type</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="food_only" class="eats-filter-checkbox" name="type" value="food_only">
                        <label for="food_only">Food Only</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="drinks_only" class="eats-filter-checkbox" name="type"
                            value="drinks_only">
                        <label for="drinks_only">Drinks Only</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Cuisine</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="indonesian" class="eats-filter-checkbox" name="cuisine[]"
                            value="indonesian">
                        <label for="indonesian">Indonesian</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="western" class="eats-filter-checkbox" name="cuisine[]" value="western">
                        <label for="western">Western</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="japanese" class="eats-filter-checkbox" name="cuisine[]"
                            value="japanese">
                        <label for="japanese">Japanese</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="chinese" class="eats-filter-checkbox" name="cuisine[]" value="chinese">
                        <label for="chinese">Chinese</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="other" class="eats-filter-checkbox" name="cuisine[]" value="other">
                        <label for="other">Other</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Price Range</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="under_price" class="eats-filter-checkbox" name="price_range"
                            value="under_price">
                        <label for="under_price">&lt;Rp10,000</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="thirty_price" class="eats-filter-checkbox" name="price_range"
                            value="thirty_price">
                        <label for="thirty_price">Rp10,000 - Rp30,000</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="sixty_price" class="eats-filter-checkbox" name="price_range"
                            value="sixty_price">
                        <label for="sixty_price">Rp30,000 - Rp60,000</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="over_price" class="eats-filter-checkbox" name="price_range"
                            value="over_price">
                        <label for="over_price">&gt;Rp60,000</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Payment Options</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="cash" class="eats-filter-checkbox" name="payment_options[]"
                            value="cash">
                        <label for="cash">Cash</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="credit" class="eats-filter-checkbox" name="payment_options[]"
                            value="credit">
                        <label for="credit">Credit Card</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="debit" class="eats-filter-checkbox" name="payment_options[]"
                            value="debit">
                        <label for="debit">Debit Card</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="mobile" class="eats-filter-checkbox" name="payment_options[]"
                            value="mobile">
                        <label for="mobile">Mobile Payment</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Special Features</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="halal" class="eats-filter-checkbox" name="special_features[]"
                            value="halal">
                        <label for="halal">Halal</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="nonhalal" class="eats-filter-checkbox" name="special_features[]"
                            value="nonhalal">
                        <label for="nonhalal">Non-Halal</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="takeaway" class="eats-filter-checkbox" name="special_features[]"
                            value="takeaway">
                        <label for="takeaway">Takeaway Available</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="indoor" class="eats-filter-checkbox" name="special_features[]"
                            value="indoor">
                        <label for="indoor">Indoor Seating</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="outdoor" class="eats-filter-checkbox" name="special_features[]"
                            value="outdoor">
                        <label for="outdoor">Outdoor Seating</label>
                    </div>
                </div>
                <button type="submit" class="eats-filter-submit">Apply Filters</button>
            </form>
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
                                <img src="<?php echo e(asset('images/star.svg')); ?>" alt="Star Icon" class="eats-card-star-icon">
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to submit the filter form when the Apply Filters button is clicked
            document.querySelector('.eats-filter-submit').addEventListener('click', function() {
                console.log('Apply Filters button clicked'); // Debugging statement
                const checkboxes = document.querySelectorAll('.eats-filter-checkbox:checked');
                const formData = new FormData(document.getElementById('filterForm'));

                checkboxes.forEach(function(checkbox) {
                    formData.append(checkbox.name, checkbox.value);
                });

                // Submit the form with appended checkbox values
                fetch('<?php echo e(route('eats.filter')); ?>', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                }).then(function(response) {
                    // Handle response as needed
                    console.log(response);
                }).catch(function(error) {
                    console.error('Error:', error);
                });
            });

            // Function to check previously selected checkboxes
            let checkboxes = document.querySelectorAll('.eats-filter-checkbox');
            checkboxes.forEach(function(checkbox) {
                if (localStorage.getItem(checkbox.id) === 'checked') {
                    checkbox.checked = true;
                }
            });

            // Event listener to store checkbox state in localStorage
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    localStorage.setItem(checkbox.id, checkbox.checked ? 'checked' : '');
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ivand\Documents\College\Projects\Tarumaeats\resources\views/eats.blade.php ENDPATH**/ ?>