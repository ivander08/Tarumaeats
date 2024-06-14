<div class="page-container">
    <!-- Conditionally include the header only if the headerClass is not 'show-header' -->
    @if(empty($headerClass) || $headerClass !== 'show-header')
        @include('partials.header', ['class' => $headerClass ?? ''])
    @endif

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</div>