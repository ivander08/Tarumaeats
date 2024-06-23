@extends('layouts.app', ['headerClass' => 'home-header'])

@section('title', 'Home')

@section('content')
    </form>
    <div class="button-container-background">
        <div class="button-container">
            <form id="filterForm" method="POST" action="{{ route('eats.filter') }}">
                @csrf
                <input type="hidden" name="campus[]" id="campusType" value="">
                <button class="restaurant-button" onclick="submitForm('untar_satu')">
                    <span>UNTAR 1</span>
                </button>
                <button class="restaurant-button-dua" onclick="submitForm('untar_dua')">
                    <span class="button-dua">UNTAR 2</span>
                </button>
            </form>
        </div>
    </div>
    <div class="home-head">
        <div class="home-head-text">
            <div class="home-head-text-settings">
                <div class="vl-home"></div>
                <h1>Featured Eats</h1>
                <p>The best eats recommended by us.</p>
            </div>
            <div class="home-results-container">
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
    </div>

    <script>
        function submitForm(campusType) {
            document.getElementById('campusType').value = campusType;
            document.getElementById('filterForm').submit();
        }
    </script>
@endsection
