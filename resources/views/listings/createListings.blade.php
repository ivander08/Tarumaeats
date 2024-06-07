@extends('layouts.app')

@section('title', 'User - Create Listings')

@section('content')
    <div class="user-listings-head">
        <div class="user-listings-head-text">
            <div class="user-listings-head-text-settings">
                <div class="vl-red"></div>
                <h1>Create Listings</h1>
            </div>
            <a href="#">My Details</a>
            <a href="#">My Listings</a>
        </div>
        <a href="{{ url('user/listings/createListings') }}" style="text-decoration: none;">
            <button type="button" id="save-create-listing-btn" class="user-listings-create-save">Save</button>
        </a>
    </div>
    <div class="user-listings-create-forms">
    </div>
@endsection
