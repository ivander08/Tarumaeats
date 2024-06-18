@extends('layouts.app')

@section('title', 'Edit Listing')

@section('content')
    <div class="user-listings-head">
        <div class="user-listings-head-text">
            <div class="user-listings-head-text-settings">
                <div class="vl-red"></div>
                <h1>Edit Listing</h1>
            </div>
            <a href="#">My Details</a>
            <a href="#">My Listings</a>
        </div>
    </div>
    <div class="user-listings-create-forms">
        <form id="edit-listing-form" action="{{ route('admin.listings.update', $listing->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="create-text-forms-container">
                <h1>Location Information</h1>
                <div class="create-text-forms">
                    <div class="create-form-group">
                        <input type="text" class="create-form-control" placeholder="Location Name*" id="location_name"
                            name="location_name" value="{{ $listing->location_name }}" required>
                    </div>

                    <div class="create-form-group">
                        <input type="text" class="create-form-control" placeholder="Location Address*"
                            id="location_address" name="location_address" value="{{ $listing->location_address }}" required>
                    </div>

                    <div class="create-form-group">
                        <input type="text" class="create-form-control" placeholder="Website" id="website"
                            name="website" value="{{ $listing->website }}">
                    </div>

                    <div class="create-form-group">
                        <input type="text" class="create-form-control" placeholder="Phone Number" id="phone_number"
                            name="phone_number" value="{{ $listing->phone_number }}">
                    </div>

                    <div class="create-form-group">
                        <input type="email" class="create-form-control" placeholder="Email" id="email" name="email"
                            value="{{ $listing->email }}">
                    </div>

                    <div class="create-form-group">
                        <input type="text" class="create-form-control" placeholder="Owner Name" id="name" name="name"
                            value="{{ $listing->name }}">
                    </div>
                </div>
            </div>

            <div class="create-h-line"></div>

            <div class="create-image-forms-container">
                <h1>Images</h1>
                <div class="create-image-forms">
                    <div class="create-form-image-group">
                        <label for="main_image">Main Image*</label>
                        <input type="file" class="create-form-control" id="main_image" name="main_image"
                            accept="image/*">
                        <img id="main_image_preview" src="{{ 'data:image;base64,' . $listing->main_image }}"
                            alt="Main Image Preview" style="max-height: 200px; object-fit: cover;">
                    </div>

                    <div class="create-form-image-group">
                        <label for="banner_image">Banner Image*</label>
                        <input type="file" class="create-form-control" id="banner_image" name="banner_image"
                            accept="image/*">
                        <img id="banner_image_preview" src="{{ 'data:image;base64,' . $listing->banner_image }}"
                            alt="Banner Image Preview" style="max-height: 200px; object-fit: cover;">
                    </div>

                    <div class="create-form-image-group">
                        <label for="carousel_images">Carousel Images*</label>
                        <input type="file" class="create-form-control" id="carousel_images" name="carousel_images[]"
                            accept="image/*" multiple>
                        @foreach (json_decode($listing->carousel_images) as $carouselImage)
                            <img src="{{ 'data:image;base64,' . $carouselImage }}" alt="Carousel Image Preview"
                                style="max-height: 200px; object-fit: cover;">
                        @endforeach
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
                                    value="untar_satu" {{ $listing->campus == 'untar_satu' ? 'checked' : '' }} required>
                                <label for="untar_satu">UNTAR 1</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="untar_dua" name="campus"
                                    value="untar_dua" {{ $listing->campus == 'untar_dua' ? 'checked' : '' }} required>
                                <label for="untar_dua">UNTAR 2</label>
                            </div>
                        </div>
                    </div>

                    <div class="create-form-group">
                        <label>Type</label>
                        <div class="create-checkbox-group">
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="food_only" name="type"
                                    value="food_only" {{ $listing->type == 'food_only' ? 'checked' : '' }}>
                                <label for="food_only">Food Only</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="drinks_only" name="type"
                                    value="drinks_only" {{ $listing->type == 'drinks_only' ? 'checked' : '' }}>
                                <label for="drinks_only">Drinks Only</label>
                            </div>
                        </div>
                    </div>

                    <div class="create-form-group">
                        <label>Cuisine*</label>
                        <div class="create-checkbox-group">
                            @foreach (['indonesian', 'western', 'japanese', 'chinese', 'other'] as $cuisine)
                                <div class="create-checkbox-pack">
                                    <input type="checkbox" class="create-form-checkbox" id="{{ $cuisine }}"
                                        name="cuisine[]" value="{{ $cuisine }}"
                                        {{ in_array($cuisine, json_decode($listing->cuisine)) ? 'checked' : '' }}>
                                    <label for="{{ $cuisine }}">{{ ucfirst($cuisine) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="create-form-group">
                        <label>Price Range*</label>
                        <div class="create-checkbox-group">
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="under_price" name="price_range"
                                    value="under_price" {{ $listing->price_range == 'under_price' ? 'checked' : '' }}
                                    required>
                                <label for="under_price">&lt;Rp10,000</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="thirty_price" name="price_range"
                                    value="thirty_price" {{ $listing->price_range == 'thirty_price' ? 'checked' : '' }}
                                    required>
                                <label for="thirty_price">Rp10,000 - Rp30,0000</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="sixty_price" name="price_range"
                                    value="sixty_price" {{ $listing->price_range == 'sixty_price' ? 'checked' : '' }}
                                    required>
                                <label for="sixty_price">Rp30,000 - Rp60,0000</label>
                            </div>
                            <div class="create-checkbox-pack">
                                <input type="radio" class="create-form-radio" id="over_price" name="price_range"
                                    value="over_price" {{ $listing->price_range == 'over_price' ? 'checked' : '' }}
                                    required>
                                <label for="over_price">&gt;Rp60,000</label>
                            </div>
                        </div>
                    </div>

                    <div class="create-form-group">
                        <label>Payment Options*</label>
                        <div class="create-checkbox-group">
                            @foreach (['cash', 'credit', 'debit', 'mobile'] as $payment)
                                <div class="create-checkbox-pack">
                                    <input type="checkbox" class="create-form-checkbox" id="{{ $payment }}"
                                        name="payment_options[]" value="{{ $payment }}"
                                        {{ in_array($payment, json_decode($listing->payment_options)) ? 'checked' : '' }}>
                                    <label for="{{ $payment }}">{{ ucfirst($payment) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="edit-submit-container">
                <div class="alert alert-danger">
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <button type="submit" class="edit-submit">Update Listing</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('main_image').addEventListener('change', function(event) {
            let reader = new FileReader();
            reader.onload = function() {
                let output = document.getElementById('main_image_preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        document.getElementById('banner_image').addEventListener('change', function(event) {
            let reader = new FileReader();
            reader.onload = function() {
                let output = document.getElementById('banner_image_preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        document.getElementById('carousel_images').addEventListener('change', function(event) {
            let outputContainer = document.querySelector('.create-form-image-group');
            outputContainer.innerHTML = '';
            Array.from(event.target.files).forEach(file => {
                let reader = new FileReader();
                reader.onload = function() {
                    let img = document.createElement('img');
                    img.src = reader.result;
                    img.style.maxHeight = '200px';
                    img.style.objectFit = 'cover';
                    outputContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
