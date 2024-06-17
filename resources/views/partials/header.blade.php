<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tarumaeats')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
</head>

<body>
    <header class="{{ $class ?? '' }}">
        <nav>
            <div class="nav-left">
                <img src="{{ asset('images/logo.png') }}" alt="Tarumaeats Logo">
                <p>TARUMAEATS</p>
            </div>
            <div class="nav-right">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/eats">Eats</a></li>
                    <li><a href="/user/listings">User</a></li>
                </ul>
            </div>
        </nav>
        @if ($class === 'home-header')
            <div class="home-content">
                <h1>FIND THE BEST EATS NEAR UNTAR</h1>
                <p>Find the local places that you love according to your taste.</p>
                <div class="home-search-bar">
                    <form method="POST" action="{{ route('eats.filter') }}">
                        @csrf
                        <div class="home-search-form">
                            <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="home-search-icon">
                            <input type="text" name="search" placeholder="What you are looking for..."
                                value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="home-search-submit">Search</button>
                    </form>
                </div>
            </div>
        @endif
    </header>
