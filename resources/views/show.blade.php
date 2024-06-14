@extends('layouts.app', ['headerClass' => 'show-header'])

@section('title', $listing->location_name)

@if (!function_exists('PriceRangeDisplay'))
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
@endif

@section('content')
    <div class="show-background-image-container"
        style="background-image: url('data:image/jpeg;base64,{{ $listing->banner_image }}');">
        @include('partials.header', ['class' => 'show-header'])
    </div>
    <div class="show-red-bar">
        <h2>Description</h2>
    </div>
    <div class="show-info-container">
        <div class="show-name-tags">
            <div class="show-top">
                <div class="show-name-address-line">
                    <div class="show-vl"></div>
                    <div class="show-name-address">
                        <h1>{{ $listing->location_name }} </h1>
                        <h2>{{ $listing->location_address }} </h2>
                    </div>
                </div>
                <div class="show-rating-container">
                    <div class="show-rating">
                        <img src="{{ asset('images/star.svg') }}" alt="Star Icon" class="show-star-icon">
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
                    @auth
                        <form id="ratingForm" action="{{ route('ratings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_name" value="{{ auth()->user()->name }}">
                            <input type="hidden" name="location_name" value="{{ $listing->location_name }}">
                            <div class="show-rating-interact">
                                <input type="radio" name="rating" id="star1" value="1"><label
                                    for="star1"></label>
                                <input type="radio" name="rating" id="star2" value="2"><label
                                    for="star2"></label>
                                <input type="radio" name="rating" id="star3" value="3"><label
                                    for="star3"></label>
                                <input type="radio" name="rating" id="star4" value="4"><label
                                    for="star4"></label>
                                <input type="radio" name="rating" id="star5" value="5"><label
                                    for="star5"></label>
                            </div>
                        </form>
                    @endauth

                </div>
            </div>
            <div class="show-tags">

            </div>
        </div>
        <div class="show-contact">

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const starInputs = document.querySelectorAll('.show-rating-interact input[type="radio"]');
            const starLabels = document.querySelectorAll('.show-rating-interact label');

            const userRating = {{ $userRating ?? 0 }};

            starInputs.forEach((input, index) => {
                input.addEventListener('change', () => {
                    const rating = index + 1;
                    updateStars(rating);
                    document.getElementById('ratingForm').submit();
                });

                input.addEventListener('mouseover', () => {
                    fillStars(index + 1);
                });

                input.addEventListener('mouseout', () => {
                    fillStars(userRating);
                });
            });

            function updateStars(rating) {
                fillStars(rating);
            }

            function fillStars(rating) {
                starLabels.forEach((label, idx) => {
                    label.style.backgroundImage = idx < rating ? "url('../images/starfill.svg')" :
                        "url('../images/starunfill.svg')";
                });
            }

            fillStars(userRating);
        });
    </script>
@endsection
