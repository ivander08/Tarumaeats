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
        <button type="button" id="save-create-listing-btn" class="user-listings-create-save" onclick="document.getElementById('create-listing-form').submit();">Save</button>
    </div>
    <div class="user-listings-create-forms">
        <form id="create-listing-form" action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="name" value="{{ auth()->user()->name }}">

            <div class="form-group">
                <label for="location_name">Location Name</label>
                <input type="text" class="form-control" id="location_name" name="location_name" required>
            </div>

            <div class="form-group">
                <label for="location_address">Location Address</label>
                <input type="text" class="form-control" id="location_address" name="location_address" required>
            </div>

            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" name="website">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude">
            </div>

            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude">
            </div>

            <div class="form-group">
                <label for="images">Images</label>
                <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
            </div>

            <div class="form-group">
                <label>Type</label><br>
                <div class="checkbox-group">
                    <label><input type="radio" name="type" value="food_only">Food Only</label><br>
                    <label><input type="radio" name="type" value="drinks_only">Drinks Only</label><br>
                </div>
            </div>

            <div class="form-group">
                <label>Cuisine</label><br>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="cuisine[]" value="indonesian">Indonesian</label><br>
                    <label><input type="checkbox" name="cuisine[]" value="western">Western</label><br>
                    <label><input type="checkbox" name="cuisine[]" value="japanese">Japanese</label><br>
                    <label><input type="checkbox" name="cuisine[]" value="chinese">Chinese</label><br>
                    <label><input type="checkbox" name="cuisine[]" value="other">Other</label><br>
            </div>

            <div class="form-group">
                <label>Price Range</label><br>
                <div class="checkbox-group">
                    <label><input type="radio" name="price_range" value="under_price">&lt;Rp10,000</label><br>
                    <label><input type="radio" name="price_range" value="thirty_price">Rp10,000 - Rp30,0000</label><br>
                    <label><input type="radio" name="price_range" value="sixty_price">Rp30,000 - Rp60,0000</label><br>
                    <label><input type="radio" name="price_range" value="over_price">&gt;Rp60,000</label><br>
                </div>
            </div>

            <div class="form-group">
                <label>Payment Options</label><br>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="payment_options[]" value="cash"> Cash</label><br>
                    <label><input type="checkbox" name="payment_options[]" value="credit"> Credit Card</label><br>
                    <label><input type="checkbox" name="payment_options[]" value="debit"> Debit Card</label><br>
                    <label><input type="checkbox" name="payment_options[]" value="mobile"> Mobile Payment</label><br>
                </div>
            </div>

            <div class="form-group">
                <label>Special Features</label><br>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="special_features[]" value="halal">Halal</label><br>
                    <label><input type="checkbox" name="special_features[]" value="nonhalal">Non-Halal</label><br>
                    <label><input type="checkbox" name="special_features[]" value="takeaway">Takeaway Available</label><br>
                    <label><input type="checkbox" name="special_features[]" value="indoor">Indoor Sesating</label><br>
                    <label><input type="checkbox" name="special_features[]" value="outdoor">Outdoor Seating</label><br>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>

        <a href="{{ route('listings') }}"><button class="btn btn-secondary">Back</button></a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
