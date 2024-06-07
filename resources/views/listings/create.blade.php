<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="location_name">Location Name</label>
        <input type="text" class="form-control" id="location_name" name="location_name" required>
    </div>

    <div class="form-group">
        <label for="location_address">Location Address</label>
        <input type="text" class="form-control" id="location_address" name="location_address" required>
    </div>

    <div class="form-group">
        <label for="price_range">Price Range</label>
        <input type="text" class="form-control" id="price_range" name="price_range" required>
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
        <label>Tags</label><br>
        <div class="checkbox-group">
            <label><input type="checkbox" name="tags[]" value="Restaurant"> Restaurant</label><br>
            <label><input type="checkbox" name="tags[]" value="Cafe"> Cafe</label><br>
            <label><input type="checkbox" name="tags[]" value="Stall/Kiosk"> Stall/Kiosk</label><br>
            <label><input type="checkbox" name="tags[]" value="Beverage"> Beverage</label><br>
            <label><input type="checkbox" name="tags[]" value="Buffet"> Buffet</label><br>
            <label><input type="checkbox" name="tags[]" value="Indonesian"> Indonesian</label><br>
            <label><input type="checkbox" name="tags[]" value="Western"> Western</label><br>
            <label><input type="checkbox" name="tags[]" value="Japanese"> Japanese</label><br>
            <label><input type="checkbox" name="tags[]" value="Chinese"> Chinese</label><br>
            <label><input type="checkbox" name="tags[]" value="Italian"> Italian</label><br>
            <label><input type="checkbox" name="tags[]" value="Middle Eastern"> Middle Eastern</label><br>
        </div>
    </div>

    <div class="form-group">
        <label>Special Features</label><br>
        <div class="checkbox-group">
            <label><input type="checkbox" name="special_features[]" value="Halal"> Halal</label><br>
            <label><input type="checkbox" name="special_features[]" value="Wi-Fi Available"> Wi-Fi Available</label><br>
            <label><input type="checkbox" name="special_features[]" value="Pet-Friendly"> Pet-Friendly</label><br>
            <label><input type="checkbox" name="special_features[]" value="Smoking Area"> Smoking Area</label><br>
            <label><input type="checkbox" name="special_features[]" value="Outdoor Seating"> Outdoor Seating</label><br>
            <label><input type="checkbox" name="special_features[]" value="Indoor Seating"> Indoor Seating</label><br>
            <label><input type="checkbox" name="special_features[]" value="Takeaway Available"> Takeaway Available</label><br>
        </div>
    </div>

    <div class="form-group">
        <label>Price Per Person</label><br>
        <div class="checkbox-group">
            <label><input type="radio" name="price_per_person" value="<Rp15,999"><Rp15,999</label><br>
            <label><input type="radio" name="price_per_person" value="Rp16,000 - Rp44,999"> Rp16,000 - Rp44,999</label><br>
            <label><input type="radio" name="price_per_person" value="Rp45,000 - Rp99,999"> Rp45,000 - Rp99,999</label><br>
            <label><input type="radio" name="price_per_person" value="Rp100,000 - Rp299,999"> Rp100,000 - Rp299,999</label><br>
            <label><input type="radio" name="price_per_person" value=">Rp300,000">>Rp300,000</label><br>
        </div>
    </div>

    <div class="form-group">
        <label>Payment Options</label><br>
        <div class="checkbox-group">
            <label><input type="checkbox" name="payment_options[]" value="Cash"> Cash</label><br>
            <label><input type="checkbox" name="payment_options[]" value="Credit Card"> Credit Card</label><br>
            <label><input type="checkbox" name="payment_options[]" value="Debit Card"> Debit Card</label><br>
            <label><input type="checkbox" name="payment_options[]" value="Mobile Payment"> Mobile Payment</label><br>
        </div>
    </div>

    <div class="form-group">
        <label for="open_hours">Open Hours</label>
        <input type="text" class="form-control" id="open_hours" name="open_hours">
    </div>

    <div class="form-group">
        <label for="closed_hours">Closed Hours</label>
        <input type="text" class="form-control" id="closed_hours" name="closed_hours">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>

<a href="{{ route('listings') }}"><button>Back</button></a>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>
