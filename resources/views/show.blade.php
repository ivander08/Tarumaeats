@extends('layouts.app', ['headerClass' => 'show-header'])

@section('title', $listing->location_name)

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
            <div class="show-name-review">
                <div class="vl-red"></div>
                <h1>{{ $listing->location_name }}</h1>
            </div>
        </div>
        <div class="show-contact">
            
        </div>
    </div>
@endsection
