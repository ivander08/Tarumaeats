<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Location Name</th>
                <th scope="col">Location Address</th>
                <th scope="col">Price Range</th>
                <th scope="col">Website</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Email</th>
                <th scope="col">Latitude</th>
                <th scope="col">Longitude</th>
                <th scope="col">Main Image</th>
                <th scope="col">Banner Image</th>
                <th scope="col">Carousel Images</th>
                <th scope="col">Type</th>
                <th scope="col">Cuisine</th>
                <th scope="col">Payment Options</th>
                <th scope="col">Special Features</th>
                <th scope="col">Approval Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listings as $listing)
                <tr>
                    <td>{{ $listing->name }}</td>
                    <td>{{ $listing->location_name }}</td>
                    <td>{{ $listing->location_address }}</td>
                    <td>{{ $listing->price_range }}</td>
                    <td>{{ $listing->website }}</td>
                    <td>{{ $listing->phone_number }}</td>
                    <td>{{ $listing->email }}</td>
                    <td>{{ $listing->latitude }}</td>
                    <td>{{ $listing->longitude }}</td>
                    <td>
                        @if ($listing->main_image)
                            <img src="data:image/jpeg;base64,{{ $listing->main_image }}" width="100" height="100"
                                alt="Main Image">
                        @endif
                    </td>
                    <td>
                        @if ($listing->banner_image)
                            <img src="data:image/jpeg;base64,{{ $listing->banner_image }}" width="100"
                                height="100" alt="Banner Image">
                        @endif
                    </td>
                    <td>
                        @if ($listing->carousel_images)
                            @php
                                $carouselImages = is_array($listing->carousel_images)
                                    ? $listing->carousel_images
                                    : json_decode($listing->carousel_images, true);
                            @endphp
                            @foreach ($carouselImages as $carouselImage)
                                <img src="data:image/jpeg;base64,{{ $carouselImage }}" width="100" height="100"
                                    alt="Carousel Image">
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $listing->type }}</td>
                    <td>
                        @if ($listing->cuisine)
                            @foreach (json_decode($listing->cuisine) as $cuisine)
                                {{ $cuisine }}<br>
                            @endforeach
                        @else
                            No cuisine
                        @endif
                    </td>
                    <td>
                        @if ($listing->payment_options)
                            @foreach (json_decode($listing->payment_options) as $paymentOption)
                                {{ $paymentOption }}<br>
                            @endforeach
                        @else
                            No payment options
                        @endif
                    </td>
                    <td>
                        @if ($listing->special_features)
                            @foreach (json_decode($listing->special_features) as $specialFeature)
                                {{ $specialFeature }}<br>
                            @endforeach
                        @else
                            No special features
                        @endif
                    </td>
                    <td>{{ $listing->approval_status }}</td>
                    <td>
                        <a href="{{ route('listings.edit', $listing->id) }}">Edit</a>
                        <form action="{{ route('listings.destroy', $listing->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button><a href="{{ route('listings.create') }}">Add listing</a></button>
</body>

</html>
