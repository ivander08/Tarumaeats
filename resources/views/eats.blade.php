@extends('layouts.app')

@section('title', 'Your Page Title')

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
                <input type="checkbox" id="favourite" class="eats-filter-checkbox">
                <label for="favourite">Show Only Favourites</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="all" class="eats-filter-checkbox">
                <label for="all">Show All</label>
            </div>
        </div>
        <hr>
        <div class="eats-filter-pack-container">
            <h3>Type</h3>
            <div class="eats-filter-pack">
                <input type="checkbox" id="restaurant" class="eats-filter-checkbox">
                <label for="restaurant">Restaurant</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="cafe" class="eats-filter-checkbox">
                <label for="cafe">Café</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="stall" class="eats-filter-checkbox">
                <label for="stall">Stall/Kiosk</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="beverage" class="eats-filter-checkbox">
                <label for="beverage">Beverage</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="buffet" class="eats-filter-checkbox">
                <label for="buffet">Buffet</label>
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
                <input type="checkbox" id="italian" class="eats-filter-checkbox">
                <label for="italian">Italian</label>
            </div>
            <div class="eats-filter-pack">
                <input type="checkbox" id="and-so-on" class="eats-filter-checkbox">
                <label for="and-so-on">And so on...</label>
            </div>
        </div>
    </div>
    <div class="eats-results-container">
        <div class="eats-cards-container">
            <div class="eats-card-image">
                <button class="eats-card-heart-button" aria-label="Add to favorites">
                    <img src="{{ asset('images/heart.svg') }}" alt="Heart Icon" class="eats-card-heart-icon">
                </button>
            </div>
            <div class="eats-card-content">
                <div class="eats-card-name-rating">
                    <h1>Solaria - Mal Ciputra</h1>
                    <div class="eats-card-rating">
                        <img src="{{ asset('images/star.svg') }}" alt="Star Icon" class="eats-card-star-icon">
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
                    <img src="{{ asset('images/heart.svg') }}" alt="Heart Icon" class="eats-card-heart-icon">
                </button>
            </div>
            <div class="eats-card-content">
                <div class="eats-card-name-rating">
                    <h1>Solaria - Mal Ciputra</h1>
                    <div class="eats-card-rating">
                        <img src="{{ asset('images/star.svg') }}" alt="Star Icon" class="eats-card-star-icon">
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
                    <img src="{{ asset('images/heart.svg') }}" alt="Heart Icon" class="eats-card-heart-icon">
                </button>
            </div>
            <div class="eats-card-content">
                <div class="eats-card-name-rating">
                    <h1>Solaria - Mal Ciputra</h1>
                    <div class="eats-card-rating">
                        <img src="{{ asset('images/star.svg') }}" alt="Star Icon" class="eats-card-star-icon">
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
                    <img src="{{ asset('images/heart.svg') }}" alt="Heart Icon" class="eats-card-heart-icon">
                </button>
            </div>
            <div class="eats-card-content">
                <div class="eats-card-name-rating">
                    <h1>Solaria - Mal Ciputra</h1>
                    <div class="eats-card-rating">
                        <img src="{{ asset('images/star.svg') }}" alt="Star Icon" class="eats-card-star-icon">
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
                    <img src="{{ asset('images/heart.svg') }}" alt="Heart Icon" class="eats-card-heart-icon">
                </button>
            </div>
            <div class="eats-card-content">
                <div class="eats-card-name-rating">
                    <h1>Solaria - Mal Ciputra</h1>
                    <div class="eats-card-rating">
                        <img src="{{ asset('images/star.svg') }}" alt="Star Icon" class="eats-card-star-icon">
                        <h3>2.5(176)
                    </div>
                </div>
                <p>Rp16,000 - Rp44,999
                <h2>Mall Ciputra Jakarta, Lantai 5</h2>
            </div>
        </div>
    </div>
</div>
@endsection