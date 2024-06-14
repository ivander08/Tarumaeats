@extends('layouts.app')

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

@endsection
