@extends('layouts.app', ['headerClass' => 'home-header'])

@section('title', 'Home')

@section('content')
@auth
</form>
<div class="button-container-background">
    <div class="button-container">
        <button class="restaurant-button">
            <img src="../images/forkandknife.svg" alt="Fork and Knife Icon">
            <span>Untar 1</span>
        </button>
        <button class="restaurant-button">
            <img src="../images/forkandknife.svg" alt="Fork and Knife Icon">
            <span>Untar 2</span>
        </button>
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
@else
@endauth
@endsection