<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Location Name</th>
      <th scope="col">Location Address</th>
      <th scope="col">Price Range</th>
      <th scope="col">Website</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Email</th>
      <th scope="col">Latitude</th>
      <th scope="col">Longitude</th>
      <th scope="col">Images</th>
      <th scope="col">Tags</th>
      <th scope="col">Special Features</th>
      <th scope="col">Price Per Person</th>
      <th scope="col">Payment Options</th>
      <th scope="col">Open Hours</th>
      <th scope="col">Closed Hours</th>
      <th scope="col">Approval Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($listings as $listing)
    <tr>
      <td>{{ $listing->id }}</td>
      <td>{{ $listing->location_name }}</td>
      <td>{{ $listing->location_address }}</td>
      <td>{{ $listing->price_range }}</td>
      <td>{{ $listing->website }}</td>
      <td>{{ $listing->phone_number }}</td>
      <td>{{ $listing->email }}</td>
      <td>{{ $listing->latitude }}</td>
      <td>{{ $listing->longitude }}</td>
      <td>
      @if($listing->images)
        @php
            $images = json_decode($listing->images, true);
        @endphp
            @foreach ($images as $image)
                <img src="data:image/jpeg;base64,{{ $image }}" width="100" height="100">
            @endforeach
        @endif
      </td>
      <td>
        @if ($listing->tags)
            @foreach(json_decode($listing->tags) as $tag)
                {{ $tag }}<br>
            @endforeach
        @else
            No tags
        @endif
    </td>


    <td>
    @if ($listing->special_features)
        @foreach(json_decode($listing->special_features) as $sf)
            {{ $sf }}<br>
        @endforeach
    @else
        {{ $listing->special_features }}
    @endif
</td>

<td>
    @if ($listing->price_per_person)
        {{ $listing->price_per_person }}
    @else
        No price per person
    @endif
</td>

<td>
    @if ($listing->payment_options)
        @foreach(json_decode($listing->payment_options) as $po)
            {{ $po }}<br>
        @endforeach
    @else
        No payment options
    @endif
</td>

<td>{{ $listing->open_hours }}</td>
<td>{{ $listing->closed_hours }}</td>
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