@extends('layouts.app')

@section('title', 'Your Page Title')

@section('content')
    <div class="search-container">
        <p>5 Results found</p>
        <div class="search-bar">
            <div class="search-form">
                <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="search-icon">
                <input type="text" placeholder="What you are looking for...">
            </div>
            <button type="submit" class="search-submit">Search</button>
        </div>
    </div>
@endsection
