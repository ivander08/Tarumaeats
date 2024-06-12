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
                        <th style="cursor:pointer; width: 15rem;" class="sort" data-column="name" data-order="asc">Name</th>
                        <th style="cursor:pointer; width: 5rem;">Rating</th>
                        <th style="cursor:pointer; width: 5rem;" class="sort" data-column="status" data-order="asc">Status</th>
                        <th style="cursor:pointer; width: 8rem;" class="sort" data-column="approval_status" data-order="asc">Approval</th>
                        <th style="cursor:pointer; width: 8rem;" class="sort" data-column="updated_at" data-order="desc">Last Modified
                        </th>
                        <th style="cursor:pointer; width: 10rem; text-align: end;">
                            <input type="text" id="search-input" placeholder="Search Name...">
                        </th>
                    </tr>
                </thead>
                <tbody id="listings-tbody">
                    @foreach ($listings as $listing)
                        <tr>
                            <td>{{ $listing->location_name }}</td>
                            @if ($listing->ratings_count > 0)
                            <td>{{ $listing->ratings / $listing->ratings_count }} ({{ $listing->ratings_count }})</td>
                            @else
                            <td>--</td>
                            @endif
                            <td>
                                <div class="listing-status-{{ $listing->status }}" data-id="{{ $listing->id }}"
                                    data-status="{{ $listing->status }}">
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
                                    <form id="delete-form-{{ $listing->id }}"
                                        action="{{ route('listings.destroy', $listing->id) }}" method="POST"
                                        style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="javascript:void(0);"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $listing->id }}').submit();">
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
                    data: {
                        'search': query
                    },
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

            // Function to sort table data
            function sortTable(column, order) {
                var tbody = $('#listings-tbody');
                var rows = tbody.find('tr').toArray();

                rows.sort(function(a, b) {
                    var aValue = $(a).find('td').eq(column).text();
                    var bValue = $(b).find('td').eq(column).text();

                    if (column === 4) { // If sorting by date, parse date strings
                        aValue = new Date(aValue);
                        bValue = new Date(bValue);
                    }

                    if (order === 'asc') {
                        return aValue.localeCompare(bValue);
                    } else {
                        return bValue.localeCompare(aValue);
                    }
                });

                tbody.empty().append(rows);
            }

            // Click event for sorting table
            $('.sort').on('click', function() {
                var column = $(this).index();
                var order = $(this).data('order');

                // Toggle sort order
                if (order === 'asc') {
                    $(this).data('order', 'desc');
                } else {
                    $(this).data('order', 'asc');
                }

                // Remove sort indicator from other columns
                $(this).siblings().removeAttr('data-order');

                // Add sort indicator to current column
                $(this).attr('data-order', order === 'asc' ? 'desc' : 'asc');

                // Sort table
                sortTable(column, order);
            });
        });
    </script>
@endsection
