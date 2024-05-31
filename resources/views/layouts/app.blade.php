<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tarumaeats')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header>
        <nav>
            <div class="nav-left">
                <img src="{{ asset('images/logo.png') }}" alt="Tarumaeats Logo">
                <p>TARUMAEATS</p>
            </div>
            <div class="nav-right">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/eats">Eats</a></li>
                    <li><a href="/user">User</a></li>
                </ul>
            </div>
        </nav>
    </header>
    @yield('content')
    <footer>
        <p>&copy; 2021 Tarumaeats</p>
    </footer>
</body>

</html>