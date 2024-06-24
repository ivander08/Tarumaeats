@extends('layouts.app', ['headerClass' => 'show-header'])

@section('title', $listing->location_name)

@php
// Fungsi untuk menampilkan rentang harga dalam format yang mudah dibaca
if (!function_exists('PriceRangeDisplay')) {
function PriceRangeDisplay($price_range)
{
$ranges = [
'under_price' => '<Rp10,000', 'thirty_price'=> 'Rp10,000 - Rp30,000',
    'sixty_price' => 'Rp30,000 - Rp60,000',
    'over_price' => '>Rp60,000',
    ];
    return $ranges[$price_range] ?? 'Price range not specified';
    }
    }
    // Fungsi untuk menampilkan label tag dalam format yang mudah dibaca
    if (!function_exists('tagLabel')) {
    function tagLabel($value)
    {
    $labels = [
    'untar_satu' => 'UNTAR 1',
    'untar_dua' => 'UNTAR 2',
    'food_only' => 'FOOD ONLY',
    'drinks_only' => 'DRINKS ONLY',
    'indonesian' => 'INDONESIAN',
    'western' => 'WESTERN',
    'japanese' => 'JAPANESE',
    'chinese' => 'CHINESE',
    'other' => 'OTHER',
    'under_price' => '<RP10,000', 'thirty_price'=> 'RP10,000 - RP30,000',
        'sixty_price' => 'RP30,000 - RP60,000',
        'over_price' => '>RP60,000',
        'cash' => 'CASH',
        'credit' => 'CREDIT CARD',
        'debit' => 'DEBIT CARD',
        'mobile' => 'MOBILE PAYMENT',
        'halal' => 'HALAL',
        'nonhalal' => 'NON-HALAL',
        'takeaway' => 'TAKEAWAY AVAILABLE',
        'indoor' => 'INDOOR SEATING',
        'outdoor' => 'OUTDOOR SEATING',
        ];
        return $labels[$value] ?? $value;
        }
        }
        // Menghitung jumlah dan rata-rata rating
        $ratingsCount = optional($listing->ratings)->count() ?: 0;
        $averageRating = $ratingsCount > 0 ? number_format(optional($listing->ratings)->avg('rating'), 1, '.', '') : 0;
        @endphp

        @section('content')
        // Bagian header halaman dengan gambar latar belakang
        <div class="show-background-image-container" style="background-image: url('data:image/jpeg;base64,{{ $listing->banner_image }}');">
            @include('partials.header', ['class' => 'show-header'])
        </div>
        <div class="show-red-bar">
            <h2>Description</h2>
        </div>
        // Bagian informasi utama listing
        <div class="show-info-container">
            <div class="show-name-tags">
                <div class="show-top">
                    <div class="show-name-address-line">
                        <div class="show-vl"></div>
                        <div class="show-name-address">
                            <h1 style="max-width: 35rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $listing->location_name }}
                            </h1>
                            <h2 style="max-width: 35rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $listing->location_address }}
                            </h2>
                        </div>
                    </div>
                    <div class="show-rating-container">
                        <div class="show-rating">
                            <img src="{{ asset('images/star.svg') }}" alt="Star Icon" class="show-star-icon">
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
                                @for ($i = 1; $i <= 5; $i++) <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}">
                                    <label for="star{{ $i }}"></label>
                                    @endfor
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
                    <span class="tag">{{ PriceRangeDisplay($listing->price_range) }}</span>
                    @endif
                    @if ($listing->payment_options)
                    @foreach (json_decode($listing->payment_options) as $paymentOption)
                    <span class="tag">{{ tagLabel($paymentOption) }}</span>
                    @endforeach
                    @endif
                    @if ($listing->special_features)
                    @foreach (json_decode($listing->special_features) ?? [] as $feature)
                    <span class="tag">{{ tagLabel($feature) }}</span>
                    @endforeach
                    @endif
                </div>
            </div>
            // Bagian kontak listing (website, telepon, email)
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
        // Bagian carousel gambar
        <div class="show-carousel-container">
            @if ($listing->carousel_images)
            <div class="glide">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        @foreach (json_decode($listing->carousel_images) as $index => $image)
                        <li class="glide__slide">
                            <img src="data:image/jpeg;base64,{{ $image }}" alt="Slide {{ $index + 1 }}">
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @else
            <p>No images available</p>
            @endif
        </div>
        <script>
            // Script untuk menginisialisasi carousel gambar
            new Glide('.glide', {
                type: 'carousel',
                perView: 1,
                focusAt: 'center'
            }).mount();
            // Script untuk menghandle interaksi rating pengguna
            document.addEventListener('DOMContentLoaded', (event) => {
                const starInputs = document.querySelectorAll('.show-rating-interact input[type="radio"]');
                const starLabels = document.querySelectorAll('.show-rating-interact label');
                const filledStar = "{{ asset('images/starfill.svg') }}";
                const unfilledStar = "{{ asset('images/starunfill.svg') }}";

                const userRating = {
                    {
                        $userRating ?? 0
                    }
                };

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
                        label.style.backgroundImage = idx < rating ? `url(${filledStar})` : `url(${unfilledStar})`;
                    });
                }

                fillStars(userRating);
            });
        </script>
        @endsection