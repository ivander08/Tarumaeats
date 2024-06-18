@extends('layouts.app')

@section('title', 'Admin Dashboard - Listings')

@section('content')
    <div class="user-listings-head">
        <div class="user-listings-head-text">
            <div class="user-listings-head-text-settings">
                <div class="vl-red"></div>
                <h1>User Details</h1>
            </div>
            <a href="{{ route('user') }}">My Details</a>
            <a href="{{ route('listings') }}">My Listings</a>
            @if (auth()->user()->is_admin)
                <a href="{{ route('admin.users') }}">Manage Users</a>
                <a href="{{ route('admin.listings') }}">Manage Listings</a>
            @endif
        </div>
    </div>
    <div class="user-listings-table-wrapper">
        <div class="user-listings-table">
            <table>
                <thead>
                    <tr>
                        <th style="cursor:pointer; width: 15rem;" class="sort" data-column="name" data-order="asc">Added By</th>
                        <th style="cursor:pointer; width: 15rem;" class="sort" data-column="name" data-order="asc">Location Name</th>
                        <th style="cursor:pointer; width: 5rem;" class="sort" data-column="rating" data-order="asc">Rating</th>
                        <th style="cursor:pointer; width: 5rem;" class="sort" data-column="status" data-order="asc">Status</th>
                        <th style="cursor:pointer; width: 8rem;" class="sort" data-column="approval_status" data-order="asc">Approval</th>
                        <th style="cursor:pointer; width: 8rem;" class="sort" data-column="updated_at" data-order="asc">Featured</th>
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
                            <td>{{ $listing->name }}</td>
                            <td>{{ $listing->location_name }}</td>
                            @php
                                $ratingsCount = optional($listing->ratings)->count() ?: 0;
                                $averageRating = $ratingsCount > 0 ? number_format(optional($listing->ratings)->avg('rating'), 1, '.', '') : 0;
                            @endphp
                            @if ($ratingsCount > 0)
                                <td>{{ $averageRating }} ({{ $ratingsCount }})</td>
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
                                <div class="listing-status-{{ $listing->approval_status }}" data-id="{{ $listing->id }}"
                                data-status="{{ $listing->approval_status }}">
                                    &#x2022; {{ ucfirst($listing->approval_status) }}
                                </div>
                            </td>
                            <td>
                                <div class="listing-status-{{ $listing->is_featured ? '1' : '0' }}" data-id="{{ $listing->id }}" data-status="{{ $listing->is_featured }}">
                                    &#x2022;
                                    @if ($listing->is_featured)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </div>
                            </td>
                            <td>{{ $listing->updated_at->diffForHumans() }}</td>
                            <td>
                                    <a href="{{ route('admin.preview', $listing->id) }}">(Preview Icon)</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
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

            $('.listing-status-approved, .listing-status-declined, .listing-status-pending').on('click', function() {
                var listingId = $(this).data('id');
                var currentStatus = $(this).data('status');
                var newStatus = currentStatus === 'approved' ? 'declined' : 'approved';

                $.ajax({
                    url: "{{ route('admin.listings.updateApproval') }}",
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

            $('.listing-status-0, .listing-status-1').on('click', function() {
                var listingId = $(this).data('id');
                var currentStatus = $(this).data('status');
                var newStatus = !currentStatus;

                $.ajax({
                    url: "{{ route('admin.listings.updateFeatured') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: listingId,
                        is_featured: newStatus
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
