@extends('layouts.app')

@section('title', 'Eats')

@section('content')
    <form method="POST" action="{{ route('eats.filter') }}">
        @csrf
        <div class="eats-search-container">
            <p>{{ $listings->count() }} Results found</p>
            <div class="eats-search-bar">
                <div class="eats-search-form">
                    <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="eats-search-icon">
                    <input type="text" name="search" placeholder="What you are looking for..."
                        value="{{ request('search') }}">
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
                        <input type="checkbox" id="untar_satu" class="eats-filter-checkbox" name="campus[]"
                            value="untar_satu" @if (in_array('untar_satu', request('campus', []))) checked @endif>
                        <label for="untar_satu">UNTAR 1</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="untar_dua" class="eats-filter-checkbox" name="campus[]" value="untar_dua"
                            @if (in_array('untar_dua', request('campus', []))) checked @endif>
                        <label for="untar_dua">UNTAR 2</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Type</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="food_only" class="eats-filter-checkbox" name="type[]" value="food_only"
                            @if (in_array('food_only', request('type', []))) checked @endif>
                        <label for="food_only">Food Only</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="drinks_only" class="eats-filter-checkbox" name="type[]"
                            value="drinks_only" @if (in_array('drinks_only', request('type', []))) checked @endif>
                        <label for="drinks_only">Drinks Only</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Cuisine</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="indonesian" class="eats-filter-checkbox" name="cuisine[]"
                            value="indonesian" @if (in_array('indonesian', request('cuisine', []))) checked @endif>
                        <label for="indonesian">Indonesian</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="western" class="eats-filter-checkbox" name="cuisine[]" value="western"
                            @if (in_array('western', request('cuisine', []))) checked @endif>
                        <label for="western">Western</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="japanese" class="eats-filter-checkbox" value="japanese" name="cuisine[]"
                            @if (in_array('japanese', request('cuisine', []))) checked @endif>
                        <label for="japanese">Japanese</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="chinese" class="eats-filter-checkbox" name="cuisine[]" value="chinese"
                            @if (in_array('chinese', request('cuisine', []))) checked @endif>
                        <label for="chinese">Chinese</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="other" class="eats-filter-checkbox" name="cuisine[]" value="other"
                            @if (in_array('other', request('cuisine', []))) checked @endif>
                        <label for="other">Other</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Price Range</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="under_price" class="eats-filter-checkbox" name="price_range[]"
                            value="under_price" @if (in_array('under_price', request('price_range', []))) checked @endif>
                        <label for="under_price">&lt;Rp10,000</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="thirty_price" class="eats-filter-checkbox" name="price_range[]"
                            value="thirty_price" @if (in_array('thirty_price', request('price_range', []))) checked @endif>
                        <label for="thirty_price">Rp10,000 - Rp30,000</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="sixty_price" class="eats-filter-checkbox" name="price_range[]"
                            value="sixty_price" @if (in_array('sixty_price', request('price_range', []))) checked @endif>
                        <label for="sixty_price">Rp30,000 - Rp60,000</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="over_price" class="eats-filter-checkbox" name="price_range[]"
                            value="over_price" @if (in_array('over_price', request('price_range', []))) checked @endif>
                        <label for="over_price">&gt;Rp60,000</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Payment Options</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="cash" class="eats-filter-checkbox" name="payment_options[]"
                            value="cash" @if (in_array('cash', request('payment_options', []))) checked @endif>
                        <label for="cash">Cash</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="credit" class="eats-filter-checkbox" name="payment_options[]"
                            value="credit" @if (in_array('credit', request('payment_options', []))) checked @endif>
                        <label for="credit">Credit Card</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="debit" class="eats-filter-checkbox" name="payment_options[]"
                            value="debit" @if (in_array('debit', request('payment_options', []))) checked @endif>
                        <label for="debit">Debit Card</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="mobile" class="eats-filter-checkbox" name="payment_options[]"
                            value="mobile" @if (in_array('mobile', request('payment_options', []))) checked @endif>
                        <label for="mobile">Mobile Payment</label>
                    </div>
                </div>
                <hr>
                <div class="eats-filter-pack-container">
                    <h3>Special Features</h3>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="halal" class="eats-filter-checkbox" name="special_features[]"
                            value="halal" @if (in_array('halal', request('special_features', []))) checked @endif>
                        <label for="halal">Halal</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="nonhalal" class="eats-filter-checkbox" name="special_features[]"
                            value="nonhalal" @if (in_array('nonhalal', request('special_features', []))) checked @endif>
                        <label for="nonhalal">Non-Halal</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="takeaway" class="eats-filter-checkbox" name="special_features[]"
                            value="takeaway" @if (in_array('takeaway', request('special_features', []))) checked @endif>
                        <label for="takeaway">Takeaway Available</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="indoor" class="eats-filter-checkbox" name="special_features[]"
                            value="indoor" @if (in_array('indoor', request('special_features', []))) checked @endif>
                        <label for="indoor">Indoor Seating</label>
                    </div>
                    <div class="eats-filter-pack">
                        <input type="checkbox" id="outdoor" class="eats-filter-checkbox" name="special_features[]"
                            value="outdoor" @if (in_array('outdoor', request('special_features', []))) checked @endif>
                        <label for="outdoor">Outdoor Seating</label>
                    </div>
                </div>
            </div>
            <div class="eats-results-container">
                @php
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
                @endphp
                @foreach ($listings as $listing)
                    <div class="eats-cards-container">
                        <a href="{{ route('eats.show', $listing->id) }}">
                            <div class="eats-card-image"
                                style="background-image: url('data:image/jpeg;base64,{{ $listing->main_image }}');">
                            </div>
                        </a>
                        <div class="eats-card-content">
                            <div class="eats-card-name-rating">
                                <h1 class="eats-card-name">{{ $listing->location_name }}</h1>
                                <div class="eats-card-rating">
                                    <img src="{{ asset('images/star.svg') }}" alt="Star Icon"
                                        class="eats-card-star-icon">
                                    @php
                                        $ratingsCount = optional($listing->ratings)->count() ?: 0;
                                        $averageRating =
                                            $ratingsCount > 0
                                                ? number_format(optional($listing->ratings)->avg('rating'), 1, '.', '')
                                                : 0;
                                    @endphp
                                    @if ($ratingsCount > 0)
                                        <h3>{{ $averageRating }} ({{ $ratingsCount }})</h3>
                                    @else
                                        <h3>No ratings yet</h3>
                                    @endif
                                </div>
                            </div>
                            <p>{!! PriceRangeDisplay($listing->price_range) !!}</p>
                            <h2 style="max-width: 15rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $listing->location_address }}</h2>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </form>
@endsection
