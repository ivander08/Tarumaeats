<div class="page-container">
    @include('partials.header', ['class' => $headerClass ?? ''])

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</div>