@extends('layouts.app')

@section('title', 'Admin Dashboard - Listings')

@section('content')
<!-- Bagian header dari halaman -->
<div class="user-listings-head">
    <div class="user-listings-head-text">
        <div class="user-listings-head-text-settings">
            <div class="vl-red"></div>
            <h1>Manage Listings</h1>
        </div>
        <a href="{{ route('user') }}">My Details</a>
        <a href="{{ route('listings') }}">My Listings</a>
        @if (auth()->user()->is_admin)
        <a href="{{ route('admin.users') }}">Manage Users</a>
        <a href="{{ route('admin.listings') }}" style="font-weight: bold; text-decoration: underline;">Manage
            Listings</a>
        @endif
    </div>
    <button type="button" id="excel-user-listing" class="user-listings-excel">Download Excel</button>
</div>
<!-- Bagian tabel yang menampilkan daftar listing -->
<div class="user-listings-table-wrapper">
    <div class="user-listings-table">
        <table>
            <thead>
                <tr>
                    <th style="cursor:pointer; width: 15rem;" class="sort" data-column="name" data-order="asc">Added
                        By</th>
                    <th style="cursor:pointer; width: 15rem;" class="sort" data-column="location_name" data-order="asc">
                        Location Name</th>
                    <th style="cursor:pointer; width: 5rem;" class="sort" data-column="rating" data-order="asc">Rating
                    </th>
                    <th style="cursor:pointer; width: 5rem;" class="sort" data-column="status" data-order="asc">Status
                    </th>
                    <th style="cursor:pointer; width: 8rem;" class="sort" data-column="approval_status" data-order="asc">Approval</th>
                    <th style="cursor:pointer; width: 8rem;" class="sort" data-column="featured" data-order="asc">
                        Featured</th>
                    <th style="cursor:pointer; width: 8rem;" class="sort" data-column="updated_at" data-order="desc">
                        Last Modified
                    </th>
                    <th style="cursor:pointer; width: 10rem; text-align: end;">
                        Action
                    </th>
                </tr>
            </thead>
            <!-- Bagian ini menampilkan setiap listing dalam tabel -->
            <tbody id="listings-tbody">
                @foreach ($listings as $listing)
                <tr>
                    <td>{{ $listing->name }}</td>
                    <td style="max-width: 12rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><a href="{{ route('admin.preview', $listing->id) }}">{{ $listing->location_name }}</a></td>
                    @php
                    $ratingsCount = optional($listing->ratings)->count() ?: 0;
                    $averageRating =
                    $ratingsCount > 0
                    ? number_format(optional($listing->ratings)->avg('rating'), 1, '.', '')
                    : 0;
                    @endphp
                    @if ($ratingsCount > 0)
                    <td>{{ $averageRating }} ({{ $ratingsCount }})</td>
                    @else
                    <td>0</td>
                    @endif
                    <td data-status="{{ $listing->status }}">
                        <div class="listing-status-{{ $listing->status }}" data-status="{{ $listing->status }}" data-id="{{ $listing->id }}">
                            &#x2022; {{ ucfirst($listing->status) }}
                        </div>
                    </td>
                    <td data-approval-status="{{ $listing->approval_status }}">
                        <div class="listing-status-{{ $listing->approval_status }}">
                            &#x2022; {{ ucfirst($listing->approval_status) }}
                        </div>
                    </td>
                    <td data-featured="{{ $listing->is_featured }}">
                        <div class="listing-status-{{ $listing->is_featured ? '1' : '0' }}" data-id="{{ $listing->id }}">
                            &#x2022;
                            @if ($listing->is_featured)
                            Yes
                            @else
                            No
                            @endif
                        </div>
                    </td>
                    <td data-date="{{ $listing->updated_at->timestamp }}">
                        {{ $listing->updated_at->diffForHumans() }}
                    </td>
                    <td>
                        <div class="user-listings-table-interact">
                            <form id="delete-form-{{ $listing->id }}" action="{{ route('listings.destroy', $listing->id) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $listing->id }}').submit();">
                                <img src="{{ asset('images/Trash.png') }}" alt="Delete" class="delete-button">
                            </a>
                            <a href="{{ route('admin.listings.edit', $listing->id) }}">
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

<script>
    $(document).ready(function() {
        // Handler untuk memperbarui status listing ketika diklik
        $('#listings-tbody').on('click', '.listing-status-online, .listing-status-offline', function() {
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
        // Handler untuk memperbarui status persetujuan listing ketika diklik
        $('#listings-tbody').on('click',
            '.listing-status-approved, .listing-status-declined, .listing-status-pending',
            function() {
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
        // Handler untuk memperbarui status featured listing ketika diklik
        $('#listings-tbody').on('click', '.listing-status-0, .listing-status-1', function() {
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

        // Fungsi untuk mengurutkan tabel berdasarkan kolom dan urutan yang dipilih
        function sortTable(column, order) {
            var tbody = $('#listings-tbody');
            var rows = tbody.find('tr').toArray();
            rows.sort(function(a, b) {
                var aValue, bValue;
                switch (column) {
                    case 'name':
                        aValue = $(a).find('td').eq(0).text().trim();
                        bValue = $(b).find('td').eq(0).text().trim();
                        break;
                    case 'location_name':
                        aValue = $(a).find('td').eq(1).text().trim();
                        bValue = $(b).find('td').eq(1).text().trim();
                        break;
                    case 'rating':
                        aValue = parseFloat($(a).find('td').eq(2).text());
                        bValue = parseFloat($(b).find('td').eq(2).text());
                        break;
                    case 'status':
                        aValue = $(a).find('td').eq(3).attr('data-status');
                        bValue = $(b).find('td').eq(3).attr('data-status');
                        break;
                    case 'approval_status':
                        aValue = $(a).find('td').eq(4).attr('data-approval-status');
                        bValue = $(b).find('td').eq(4).attr('data-approval-status');
                        break;
                    case 'featured':
                        aValue = $(a).find('td').eq(5).attr('data-featured');
                        bValue = $(b).find('td').eq(5).attr('data-featured');
                        break;
                    case 'updated_at':
                        aValue = parseInt($(a).find('td').eq(6).attr('data-date'));
                        bValue = parseInt($(b).find('td').eq(6).attr('data-date'));
                        break;
                    default:
                        aValue = $(a).find('td').eq(column).text().toLowerCase();
                        bValue = $(b).find('td').eq(column).text().toLowerCase();
                        break;
                }
                if (order === 'asc') {
                    return aValue > bValue ? 1 : -1;
                } else {
                    return aValue < bValue ? 1 : -1;
                }
            });
            tbody.empty().append(rows);
        }


        // Handler untuk event click pada kolom untuk mengurutkan
        $('.sort').on('click', function() {
            var column = $(this).data('column');
            var order = $(this).data('order');

            if (order === 'asc') {
                $(this).data('order', 'desc');
            } else {
                $(this).data('order', 'asc');
            }

            $(this).siblings().removeAttr('data-order');

            $(this).attr('data-order', order === 'asc' ? 'desc' : 'asc');

            sortTable(column, order);
        });

        // Fungsi untuk mengunduh data tabel dalam format Excel
        document.getElementById('excel-user-listing').addEventListener('click', function() {
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.table_to_sheet(document.querySelector('.user-listings-table table'));
            XLSX.utils.book_append_sheet(wb, ws, 'Listings');
            XLSX.writeFile(wb, 'listings.xlsx');
        });
    });
</script>
@endsection