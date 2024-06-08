<!-- resources/views/listings/partials/listingsTable.blade.php -->

@foreach($listings as $listing)
    <tr>
        <td>{{ $listing->location_name }}</td>
        <td>--</td> <!-- Assuming you have a rating system to be added here -->
        <td>
            <div class="listing-status-{{ $listing->status }}">
                &#x2022; {{ ucfirst($listing->status) }}
            </div>
        </td>
        <td>
            <div class="listing-status-{{ $listing->approval_status }}">
                &#x2022; {{ ucfirst($listing->approval_status) }}
            </div>
        </td>
        <td>{{ $listing->updated_at->diffForHumans() }}</td>
        <td>
            <div class="user-listings-table-interact">
                <form id="delete-form-{{ $listing->id }}" action="{{ route('listings.destroy', $listing->id) }}" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
                <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $listing->id }}').submit();">
                    <img src="{{ asset('images/Trash.png') }}" alt="Delete" class="delete-button">
                </a>
                <a href="{{ route('listings.edit', $listing->id) }}">
                    <img src="{{ asset('images/Edit.png') }}" alt="Edit" class="edit-button">
                </a>
            </div>
        </td>
    </tr>
@endforeach
