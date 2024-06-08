@extends('layouts.app')

@section('title', 'User - Listings')

@section('content')
    <div class="user-listings-head">
        <div class="user-listings-head-text">
            <div class="user-listings-head-text-settings">
                <div class="vl-red"></div>
                <h1>Settings</h1>
            </div>
            <a href="#">My Details</a>
            <a href="#">My Listings</a>
        </div>
        <a href="{{ route('listings.create') }}" style="text-decoration: none;">
            <button type="button" id="create-listing-btn" class="user-listings-create">Create Listing</button>
        </a>
    </div>
    <div class="user-listings-table-wrapper">
        <div class="user-listings-table">
            <table>
                <thead>
                    <tr>
                        <th style="width: 15rem;">Name</th>
                        <th style="width: 5rem;">Rating</th>
                        <th style="width: 5rem;">Status</th>
                        <th style="width: 8rem;">Approval</th>
                        <th style="width: 8rem;">Last Modified</th>
                        <th style="width: 10rem; text-align: end;">
                            <input type="text" id="search-input" placeholder="Search Name...">
                        </th>
                    </tr>
                </thead>
                <tbody id="listings-tbody">
                    @foreach($listings as $listing)
                        <tr>
                            <td>{{ $listing->location_name }}</td>
                            <td>--</td> <!-- Assuming you have a rating system to be added here -->
                            <td>
                                <div class="listing-status-{{ $listing->status }}" data-id="{{ $listing->id }}" data-status="{{ $listing->status }}">
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
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('listings.search') }}",
                    type: "GET",
                    data: {'search': query},
                    success: function(data) {
                        $('#listings-tbody').html(data);
                    }
                });
            });

            $('.listing-status-online, .listing-status-offline').on('click', function() {
                var listingId = $(this).data('id');
                var currentStatus = $(this).data('status');
                var newStatus = currentStatus === 'online' ? 'offline' : 'online';

                $.ajax({
                    url: "{{ route('listings.updateStatus') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: listingId,
                        status: newStatus
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection
