@extends('layouts.app')

@section('title', 'Eats')

@section('content')
    <div class="eats-search-container">
        <p>5 Results found</p>
        <div class="eats-search-bar">
            <div class="eats-search-form">
                <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="eats-search-icon">
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
                    <label for="thirty_price">Rp10,000 - Rp30,000</label>
                </div>
                <div class="eats-filter-pack">
                    <input type="checkbox" id="sixty_price" class="eats-filter-checkbox">
                    <label for="sixty_price">Rp30,000 - Rp60,000</label>
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
            @php
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
            @endphp
            @foreach ($listings as $listing)
                <div class="eats-cards-container">
                    <div class="eats-card-image"
                        style="background-image: url('data:image/jpeg;base64,{{ $listing->banner_image }}');">
                        <button class="eats-card-heart-button" aria-label="Add to favorites">
                            <img src="{{ asset('images/heart.svg') }}" alt="Heart Icon" class="eats-card-heart-icon">
                        </button>
                    </div>
                    <div class="eats-card-content">
                        <div class="eats-card-name-rating">
                            <h1>{{ $listing->location_name }}</h1>
                            <div class="eats-card-rating">
                                <img src="{{ asset('images/star.svg') }}" alt="Star Icon" class="eats-card-star-icon">
                                <h3>{{ $listing->rating }} ({{ $listing->reviews_count }})</h3>
                            </div>
                        </div>
                        <p>{!! PriceRangeDisplay($listing->price_range) !!}</p>
                        <h2>{{ $listing->location_address }}</h2>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
