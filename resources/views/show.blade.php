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
            <hr>
            <div class="show-tags">
                @if ($listing->campus)
                    <span class="tag">{{ tagLabel($listing->campus) }}</span>
                @endif

                @if ($listing->type)
                    <span class="tag">{{ tagLabel($listing->type) }}</span>
                @endif

                @if ($listing->cuisine)
                    @foreach (json_decode($listing->cuisine) as $cuisine)
                        <span class="tag">{{ tagLabel($cuisine) }}</span>
                    @endforeach
                @endif

                @if ($listing->price_range)
                    <span class="tag">{{ tagLabel($listing->price_range) }}</span>
                @endif

                @if ($listing->payment_options)
                    @foreach (json_decode($listing->payment_options) as $paymentOption)
                        <span class="tag">{{ tagLabel($paymentOption) }}</span>
                    @endforeach
                @endif

                @if ($listing->special_features)
                    @foreach (json_decode($listing->special_features) as $feature)
                        <span class="tag">{{ tagLabel($feature) }}</span>
                    @endforeach
                @endif

                @php
                    function tagLabel($value)
                    {
                        $labels = [
                            'untar_satu' => 'UNTAR 1',
                            'untar_dua' => 'UNTAR 2',
                            'food_only' => 'Food Only',
                            'drinks_only' => 'Drinks Only',
                            'indonesian' => 'Indonesian',
                            'western' => 'Western',
                            'japanese' => 'Japanese',
                            'chinese' => 'Chinese',
                            'other' => 'Other',
                            'under_price' => '<Rp10,000',
                            'thirty_price' => 'Rp10,000 - Rp30,000',
                            'sixty_price' => 'Rp30,000 - Rp60,000',
                            'over_price' => '>Rp60,000',
                            'cash' => 'Cash',
                            'credit' => 'Credit Card',
                            'debit' => 'Debit Card',
                            'mobile' => 'Mobile Payment',
                            'halal' => 'Halal',
                            'nonhalal' => 'Non-Halal',
                            'takeaway' => 'Takeaway Available',
                            'indoor' => 'Indoor Seating',
                            'outdoor' => 'Outdoor Seating',
                        ];

                        return $labels[$value] ?? $value;
                    }
                @endphp

            </div>
        </div>
        <div class="show-contact">
            <div class="show-website">
                <div class="show-website-icon">
                    <img src="{{ asset('images/website.svg') }}" alt="Website Icon" class="show-website-icon">
                </div>
                <div class="show-website-info">
                    <h2>Website</h2>
                    <h3>{{ $listing->website ?? 'N/A' }}</h3>
                </div>
            </div>
            <div class="show-phone">
                <div class="show-phone-icon">
                    <img src="{{ asset('images/phone.svg') }}" alt="Phone Icon" class="show-phone-icon">
                </div>
                <div class="show-phone-info">
                    <h2>Phone</h2>
                    <h3>{{ $listing->phone ?? 'N/A' }}</h3>
                </div>
            </div>
            <div class="show-email">
                <div class="show-email-icon">
                    <img src="{{ asset('images/email.svg') }}" alt="Email Icon" class="show-email-icon">
                </div>
                <div class="show-email-info">
                    <h2>Email</h2>
                    <h3>{{ $listing->email ?? 'N/A' }}</h3>
                </div>
            </div>
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
