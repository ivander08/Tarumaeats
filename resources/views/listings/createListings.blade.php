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
    </div>
    <div class="user-listings-create-forms">
        <form id="create-listing-form" action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
            </div>

            <div class="create-text-forms">
                <div class="create-form-group">
                    <input type="text" class="create-form-control" placeholder="Location Name" id="location_name"
                        name="location_name" required>
                </div>

                <div class="create-form-group">
                    <input type="text" class="create-form-control" placeholder="Location Address" id="location_address"
                        name="location_address" required>
                </div>

                <div class="create-form-group">
                    <input type="text" class="create-form-control" placeholder="Website" id="website" name="website">
                </div>

                <div class="create-form-group">
                    <input type="text" class="create-form-control" placeholder="Phone Number" id="phone_number"
                        name="phone_number">
                </div>

                <div class="create-form-group">
                    <input type="email" class="create-form-control" placeholder="Email" id="email" name="email">
                </div>

                <div class="create-form-group">
                    <input type="text" class="create-form-control" placeholder="Latitude" id="latitude" name="latitude">
                </div>

                <div class="create-form-group">
                    <input type="text" class="create-form-control" placeholder="Longitude" id="longitude"
                        name="longitude">
                </div>
            </div>

            <div class="create-h-line"></div>

            <div class="create-image-forms">
                <div class="create-form-image-group">
                    <label for="main_image">Main Image</label>
                    <input type="file" class="create-form-control" id="main_image" name="main_image" accept="image/*">
                </div>

                <div class="create-form-image-group">
                    <label for="banner_image">Banner Image</label>
                    <input type="file" class="create-form-control" id="banner_image" name="banner_image"
                        accept="image/*">
                </div>

                <div class="create-form-image-group">
                    <label for="carousel_images">Carousel Images</label>
                    <input type="file" class="create-form-control" id="carousel_images" name="carousel_images[]"
                        accept="image/*" multiple>
                </div>
            </div>

            <div class="create-h-line"></div>

            <div class="create-check-forms">
                <div class="create-form-group">
                    <label>Campus</label><br>
                    <div class="create-checkbox-group">
                        <label><input type="radio" class="create-form-radio" name="campus" value="untar_satu">UNTAR
                            1</label><br>
                        <label><input type="radio" class="create-form-radio" name="campus" value="untar_dua">UNTAR
                            2</label><br>
                    </div>
                </div>

                <div class="create-form-group">
                    <label>Type</label><br>
                    <div class="create-checkbox-group">
                        <label><input type="radio" class="create-form-radio" name="type" value="food_only">Food
                            Only</label><br>
                        <label><input type="radio" class="create-form-radio" name="type" value="drinks_only">Drinks
                            Only</label><br>
                    </div>
                </div>

                <div class="create-form-group">
                    <label>Cuisine</label><br>
                    <div class="create-checkbox-group">
                        <label><input type="checkbox" class="create-form-checkbox" name="cuisine[]"
                                value="indonesian">Indonesian</label><br>
                        <label><input type="checkbox" class="create-form-checkbox" name="cuisine[]"
                                value="western">Western</label><br>
                        <label><input type="checkbox" class="create-form-checkbox" name="cuisine[]"
                                value="japanese">Japanese</label><br>
                        <label><input type="checkbox" class="create-form-checkbox" name="cuisine[]"
                                value="chinese">Chinese</label><br>
                        <label><input type="checkbox" class="create-form-checkbox" name="cuisine[]"
                                value="other">Other</label><br>
                    </div>
                </div>
                <div class="create-form-group">
                    <label>Price Range</label><br>
                    <div class="create-checkbox-group">
                        <label><input type="radio" class="create-form-radio" name="price_range"
                                value="under_price">&lt;Rp10,000</label><br>
                        <label><input type="radio" class="create-form-radio" name="price_range"
                                value="thirty_price">Rp10,000 -
                            Rp30,0000</label><br>
                        <label><input type="radio" class="create-form-radio" name="price_range"
                                value="sixty_price">Rp30,000 -
                            Rp60,0000</label><br>
                        <label><input type="radio" class="create-form-radio" name="price_range"
                                value="over_price">&gt;Rp60,000</label><br>
                    </div>
                </div>

                <div class="create-form-group">
                    <label>Payment Options</label><br>
                    <div class="create-checkbox-group">
                        <label><input type="checkbox" class="create-form-checkbox" name="payment_options[]"
                                value="cash">
                            Cash</label><br>
                        <label><input type="checkbox" class="create-form-checkbox" name="payment_options[]"
                                value="credit">
                            Credit Card</label><br>
                        <label><input type="checkbox" class="create-form-checkbox" name="payment_options[]"
                                value="debit">
                            Debit Card</label><br>
                        <label><input type="checkbox" class="create-form-checkbox" name="payment_options[]"
                                value="mobile">
                            Mobile Payment</label><br>
                    </div>
                </div>

                <div class="create-form-group">
                    <label>Special Features</label><br>
                    <div class="create-checkbox-group">
                        <label><input type="checkbox" class="create-form-checkbox" name="special_features[]"
                                value="halal">Halal</label><br>
                        <label><input type="checkbox" class="create-form-checkbox" name="special_features[]"
                                value="nonhalal">Non-Halal</label><br>
                        <label><input type="checkbox" class="create-form-checkbox" name="special_features[]"
                                value="takeaway">Takeaway
                            Available</label><br>
                        <label><input type="checkbox" class="create-form-checkbox" name="special_features[]"
                                value="indoor">Indoor
                            Seating</label><br>
                        <label><input type="checkbox" class="create-form-checkbox" name="special_features[]"
                                value="outdoor">Outdoor
                            Seating</label><br>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>

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
