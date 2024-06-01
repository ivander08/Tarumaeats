<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <body>
  @php
    $tags = json_decode($listing->tags);
    $special_features = json_decode($listing->special_features);
    $price_range = explode('-', $listing->price_range);
    $payment_options = json_decode($listing->payment_options);
    @endphp
  <form action="{{ route('listings.update', $listing->id)}}" method="POST">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="location_name">Location Name</label>
                <input type="text" class="form-control" id="location_name" name="location_name" required value="{{$listing->location_name}}">
            </div>

            <div class="form-group">
                <label for="location_address">Location Address</label>
                <input type="text" class="form-control" id="location_address" name="location_address" required value="{{$listing->location_address}}">
            </div>

            <div class="form-group">
                <label for="price_range">Price Range</label>
                <input type="text" class="form-control" id="price_range" name="price_range" required value="{{$listing->price_range}}">
            </div>

            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" name="website" value="{{$listing->website}}">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$listing->phone_number}}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$listing->email}}">
            </div>

            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude" value="{{$listing->latitude}}">
            </div>

            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude" value="{{$listing->longitude}}">
            </div>

            <div class="form-group">
                <label for="images">Images</label>
                <input type="text" class="form-control" id="images" name="images" value="{{$listing->images}}">
            </div>

            <div class="form-group">
                <label>Tags</label><br>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="tags[]" value="Restaurant" {{ is_array($tags) && in_array('Restaurant', $tags) ? 'checked' : '' }}> Restaurant</label><br>
                    <label><input type="checkbox" name="tags[]" value="Cafe" {{ is_array($tags) && in_array('Cafe', $tags) ? 'checked' : '' }}> Cafe</label><br>
                    <label><input type="checkbox" name="tags[]" value="Stall/Kiosk" {{ is_array($tags) && in_array('Stall/Kiosk', $tags) ? 'checked' : '' }}> Stall/Kiosk</label><br>
                    <label><input type="checkbox" name="tags[]" value="Beverage" {{ is_array($tags) && in_array('Beverage', $tags) ? 'checked' : '' }}> Beverage</label><br>
                    <label><input type="checkbox" name="tags[]" value="Buffet" {{ is_array($tags) && in_array('Buffet', $tags) ? 'checked' : '' }}> Buffet</label><br>
                    <label><input type="checkbox" name="tags[]" value="Indonesian" {{ is_array($tags) && in_array('Indonesian', $tags) ? 'checked' : '' }}> Indonesian</label><br>
                    <label><input type="checkbox" name="tags[]" value="Western" {{ is_array($tags) && in_array('Western', $tags) ? 'checked' : '' }}> Western</label><br>
                    <label><input type="checkbox" name="tags[]" value="Japanese" {{ is_array($tags) && in_array('Japanese', $tags) ? 'checked' : '' }}> Japanese</label><br>
                    <label><input type="checkbox" name="tags[]" value="Chinese" {{ is_array($tags) && in_array('Chinese', $tags) ? 'checked' : '' }}> Chinese</label><br>
                    <label><input type="checkbox" name="tags[]" value="Italian" {{ is_array($tags) && in_array('Italian', $tags) ? 'checked' : '' }}> Italian</label><br>
                    <label><input type="checkbox" name="tags[]" value="Middle Eastern" {{ is_array($tags) && in_array('Middle Eastern', $tags) ? 'checked' : '' }}> Middle Eastern</label><br>
                </div>
            </div>

            <div class="form-group">
                <label>Special Features</label><br>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="special_features[]" value="Halal" {{ is_array(json_decode($listing->special_features)) && in_array('Halal', json_decode($listing->special_features)) ? 'checked' : '' }}> Halal</label><br>
                    <label><input type="checkbox" name="special_features[]" value="Wi-Fi Available" {{ is_array(json_decode($listing->special_features)) && in_array('Wi-Fi Available', json_decode($listing->special_features)) ? 'checked' : '' }}> Wi-Fi Available</label><br>
                    <label><input type="checkbox" name="special_features[]" value="Pet-Friendly" {{ is_array(json_decode($listing->special_features)) && in_array('Pet-Friendly', json_decode($listing->special_features)) ? 'checked' : '' }}> Pet-Friendly</label><br>
                    <label><input type="checkbox" name="special_features[]" value="Smoking Area" {{ is_array(json_decode($listing->special_features)) && in_array('Smoking Area', json_decode($listing->special_features)) ? 'checked' : '' }}> Smoking Area</label><br>
                    <label><input type="checkbox" name="special_features[]" value="Outdoor Seating" {{ is_array(json_decode($listing->special_features)) && in_array('Outdoor Seating', json_decode($listing->special_features)) ? 'checked' : '' }}> Outdoor Seating</label><br>
                    <label><input type="checkbox" name="special_features[]" value="Indoor Seating" {{ is_array(json_decode($listing->special_features)) && in_array('Indoor Seating', json_decode($listing->special_features)) ? 'checked' : '' }}> Indoor Seating</label><br>
                    <label><input type="checkbox" name="special_features[]" value="Takeaway Available" {{ is_array(json_decode($listing->special_features)) && in_array('Takeaway Available', json_decode($listing->special_features)) ? 'checked' : '' }}> Takeaway Available</label><br>
                </div>
            </div>

            <div class="form-group">
                <label>Price Per Person</label><br>
                <div class="checkbox-group">
                    <label><input type="radio" name="price_per_person" value="&lt;Rp15,999" {{ $listing->price_per_person === '&lt;Rp15,999' ? 'checked' : '' }}>&lt;Rp15,999</label><br>
                    <label><input type="radio" name="price_per_person" value="Rp16,000 - Rp44,999" {{ $listing->price_per_person === 'Rp16,000 - Rp44,999' ? 'checked' : '' }}> Rp16,000 - Rp44,999</label><br>
                    <label><input type="radio" name="price_per_person" value="Rp45,000 - Rp99,999" {{ $listing->price_per_person === 'Rp45,000 - Rp99,999' ? 'checked' : '' }}> Rp45,000 - Rp99,999</label><br>
                    <label><input type="radio" name="price_per_person" value="Rp100,000 - Rp299,999" {{ $listing->price_per_person === 'Rp100,000 - Rp299,999' ? 'checked' : '' }}> Rp100,000 - Rp299,999</label><br>
                    <label><input type="radio" name="price_per_person" value="&gt;Rp300,000" {{ $listing->price_per_person === '&gt;Rp300,000' ? 'checked' : '' }}>&gt;Rp300,000</label><br>
                </div>
            </div>


            <div class="form-group">
                <label>Payment Options</label><br>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="payment_options[]" value="Cash" {{ is_array(json_decode($listing->payment_options)) && in_array('Cash', json_decode($listing->payment_options)) ? 'checked' : '' }}> Cash</label><br>
                    <label><input type="checkbox" name="payment_options[]" value="Credit Card" {{ is_array(json_decode($listing->payment_options)) && in_array('Credit Card', json_decode($listing->payment_options)) ? 'checked' : '' }}> Credit Card</label><br>
                    <label><input type="checkbox" name="payment_options[]" value="Debit Card" {{ is_array(json_decode($listing->payment_options)) && in_array('Debit Card', json_decode($listing->payment_options)) ? 'checked' : '' }}> Debit Card</label><br>
                    <label><input type="checkbox" name="payment_options[]" value="Mobile Payment" {{ is_array(json_decode($listing->payment_options)) && in_array('Mobile Payment', json_decode($listing->payment_options)) ? 'checked' : '' }}> Mobile Payment</label><br>
                </div>
            </div>

            <div class="form-group">
                <label>Open Hours</label>
                <input type="text" class="form-control" name="open_hours" value="{{ $listing->open_hours }}">
            </div>

            <div class="form-group">
                <label>Closed Hours</label>
                <input type="text" class="form-control" name="closed_hours" value="{{ $listing->closed_hours }}">
            </div>




            <button type="submit" class="btn btn-primary">Save</button>
        </form>

<a href ="{{ route('listings') }}"><button>Back</button></a>

  </body>
  </html>