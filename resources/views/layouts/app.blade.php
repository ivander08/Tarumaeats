<div class="page-container">
    <!-- Secara kondisional, include header hanya jika headerClass bukan 'show-header' -->
    @if(empty($headerClass) || $headerClass !== 'show-header')
        @include('partials.header', ['class' => $headerClass ?? ''])
    @endif

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</div>