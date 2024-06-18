@extends('layouts.app')

@section('title', 'Create Listing')

@section('content')
    <div class="user-listings-head">
        <div class="user-listings-head-text">
            <div class="user-listings-head-text-settings">
                <div class="vl-red"></div>
                <h1>Create Listings</h1>
            </div>
            <a href="{{ route('user') }}">My Details</a>
            <a href="{{ route('listings') }}">My Listings</a>
            @if (auth()->user()->is_admin)
                <a href="{{ route('admin.users') }}">Manage Users</a>
                <a href="{{ route('admin.listings') }}">Manage Listings</a>
            @endif
        </div>
    </div>
    <div class="user-listings-create-forms">
        <form id="create-listing-form" action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
            </div>

            <div class="create-text-forms-container">
                <h1>Location Information</h1>
                <div class="create-text-forms">
                    <div class="create-form-group">
                        <input type="text" class="create-form-control" placeholder="Location Name*" id="location_name"
                            name="location_name" required>
                    </div>

                    <div class="create-form-group">
                        <input type="text" class="create-form-control" placeholder="Location Address*"
                            id="location_address" name="location_address" required>
                    </div>

                    <div class="create-form-group">
                        <input type="text" class="create-form-control" placeholder="Website" id="website"
                            name="website">
                    </div>

                    <div class="create-form-group">
                        <input type="text" class="create-form-control" placeholder="Phone Number" id="phone_number"
                            name="phone_number">
                    </div>

                    <div class="create-form-group">
                        <input type="email" class="create-form-control" placeholder="Email" id="email" name="email">
                    </div>
                </div>
            </div>

            <div class="create-h-line"></div>

            <div class="create-image-forms-container">
                <h1>Images</h1>
                <div class="create-image-forms">
                    <div class="create-form-image-group">
                        <label for="main_image">Main Image*</label>
                        <input type="file" class="create-form-control" id="main_image" name="main_image" accept="image/*"
                            required>
                        <img id="main_image_preview" src="#" alt="Main Image Preview"
                            style="display: none; max-height: 200px; object-fit: cover;">
                    </div>

                    <div class="create-form-image-group">
                        <label for="banner_image">Banner Image*</label>
                        <input type="file" class="create-form-control" id="banner_image" name="banner_image"
                            accept="image/*" required>
                        <img id="banner_image_preview" src="#" alt="Banner Image Preview"
                            style="display: none; max-height: 200px; object-fit: cover;">
                    </div>

                    <div class="create-form-image-group">
                        <label for="carousel_images">Carousel Images*</label>
                        <input type="file" class="create-form-control" id="carousel_images" name="carousel_images[]"
                            accept="image/*" multiple required>
                    </div>
                </div>
            </div>

            <div class="create-h-line"></div>

            <div class="create-check-forms-container">
                <h1>Tags</h1>
                <div class="create-check-forms">
                    <div class="create-form-group">
                        <label>Campus*</label>
                        <div class="create-checkbox-group">
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="untar_satu" name="campus"
                                    value="untar_satu" required>
                                <label for="untar_satu">UNTAR 1</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="untar_dua" name="campus"
                                    value="untar_dua" required>
                                <label for="untar_dua">UNTAR 2</label>
                            </div>
                        </div>
                    </div>

                    <div class="create-form-group">
                        <label>Type</label>
                        <div class="create-checkbox-group">
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="food_only" name="type"
                                    value="food_only">
                                <label for="food_only">Food Only</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="drinks_only" name="type"
                                    value="drinks_only">
                                <label for="drinks_only">Drinks Only</label>
                            </div>
                        </div>
                    </div>

                    <div class="create-form-group">
                        <label>Cuisine*</label>
                        <div class="create-checkbox-group">
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="indonesian" name="cuisine[]"
                                    value="indonesian">
                                <label for="indonesian">Indonesian</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="western" name="cuisine[]"
                                    value="western">
                                <label for="western">Western</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="japanese" name="cuisine[]"
                                    value="japanese">
                                <label for="japanese">Japanese</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="chinese" name="cuisine[]"
                                    value="chinese">
                                <label for="chinese">Chinese</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="other" name="cuisine[]"
                                    value="other">
                                <label for="other">Other</label>
                            </div>
                        </div>
                    </div>


                    <div class="create-form-group">
                        <label>Price Range*</label>
                        <div class="create-checkbox-group">
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="under_price" name="price_range"
                                    value="under_price" required>
                                <label for="under_price">&lt;Rp10,000</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="thirty_price" name="price_range"
                                    value="thirty_price" required>
                                <label for="thirty_price">Rp10,000 - Rp30,0000</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="sixty_price" name="price_range"
                                    value="sixty_price" required>
                                <label for="sixty_price">Rp30,000 - Rp60,0000</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="over_price" name="price_range"
                                    value="over_price" required>
                                <label for="over_price">&gt;Rp60,000</label>
                            </div>
                        </div>
                    </div>

                    <div class="create-form-group">
                        <label>Payment Options*</label>
                        <div class="create-checkbox-group">
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="cash"
                                    name="payment_options[]" value="cash">
                                <label for="cash">Cash</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="credit"
                                    name="payment_options[]" value="credit">
                                <label for="credit">Credit Card</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="debit"
                                    name="payment_options[]" value="debit">
                                <label for="debit">Debit Card</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="mobile"
                                    name="payment_options[]" value="mobile">
                                <label for="mobile">Mobile Payment</label>
                            </div>
                        </div>
                    </div>

                    <div class="create-form-group">
                        <label>Special Features</label>
                        <div class="create-checkbox-group">
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="halal"
                                    name="special_features[]" value="halal">
                                <label for="halal">Halal</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="nonhalal"
                                    name="special_features[]" value="nonhalal">
                                <label for="nonhalal">Non-Halal</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="takeaway"
                                    name="special_features[]" value="takeaway">
                                <label for="takeaway">Takeaway Available</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="indoor"
                                    name="special_features[]" value="indoor">
                                <label for="indoor">Indoor Seating</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="checkbox" class="create-form-checkbox" id="outdoor"
                                    name="special_features[]" value="outdoor">
                                <label for="outdoor">Outdoor Seating</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="create-save-container">
                <div class="alert alert-danger">
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <button type="submit" class="create-save">Save</button>
            </div>
        </form>
    </div>

    <script>
        // Main Image Preview
        document.getElementById('main_image').onchange = function(e) {
            var reader = new FileReader();

            reader.onload = function(event) {
                document.getElementById('main_image_preview').src = event.target.result;
                document.getElementById('main_image_preview').style.display = 'block';
            };

            reader.readAsDataURL(e.target.files[0]);
        };

        // Banner Image Preview
        document.getElementById('banner_image').onchange = function(e) {
            var reader = new FileReader();

            reader.onload = function(event) {
                document.getElementById('banner_image_preview').src = event.target.result;
                document.getElementById('banner_image_preview').style.display = 'block';
            };

            reader.readAsDataURL(e.target.files[0]);
        };
    </script>
@endsection
