@extends('layouts.app', ['headerClass' => 'home-header'])

@section('title', 'Home')

@section('content')
    </form>
    <div class="button-container-background">
        <div class="button-container">
            <form id="filterForm" method="POST" action="{{ route('eats.filter') }}">
                @csrf
                <input type="hidden" name="campus[]" id="campusType" value="">
                <button class="restaurant-button" onclick="submitForm('untar_satu')">
                    <span>UNTAR 1</span>
                </button>
                <button class="restaurant-button-dua" onclick="submitForm('untar_dua')">
                    <span class="button-dua">UNTAR 2</span>
                </button>
            </form>
        </div>
    </div>
    <div class="home-head">
        <div class="home-head-text">
            <div class="home-head-text-settings">
                <div class="vl-home"></div>
                <h1>Featured Eats</h1>
                <p>The best eats recommended by us.</p>
            </div>
        </div>
    </div>

    <script>
        function submitForm(campusType) {
            document.getElementById('campusType').value = campusType;
            document.getElementById('filterForm').submit();
        }
    </script>
@endsection
