@extends('layouts.app')

@section('title', 'Listings')

@section('content')
<!-- Bagian header halaman -->
<div class="user-listings-head">
    <div class="user-listings-head-text">
        <div class="user-listings-head-text-settings">
            <div class="vl-red"></div>
            <h1>Listings</h1>
        </div>
        <a href="{{ route('user') }}">My Details</a>
        <a href="{{ route('listings') }}" style="font-weight: bold; text-decoration: underline;">My Listings</a>
        @if (auth()->user()->is_admin)
        <a href="{{ route('admin.users') }}">Manage Users</a>
        <a href="{{ route('admin.listings') }}">Manage Listings</a>
        @endif
    </div>
    <!-- Bagian tombol download dan create listing -->
    <div class="download-create-buttons">
        <button type="button" id="excel-user-listing" class="user-listings-excel">Download Excel</button>
        <a href="{{ route('listings.create') }}" style="text-decoration: none;">
            <button type="button" id="create-listing-btn" class="user-listings-create">Create Listing</button>
        </a>
    </div>
</div>
<!-- Bagian tabel listing -->
<div class="user-listings-table-wrapper">
    <div class="user-listings-table">
        <table>
            <thead>
                <tr>
                    <th style="cursor:pointer; width: 15rem;" class="sort" data-column="name" data-order="asc">Name
                    </th>
                    <th style="cursor:pointer; width: 5rem;" class="sort" data-column="rating" data-order="asc">Rating
                    </th>
                    <th style="cursor:pointer; width: 5rem;" class="sort" data-column="status" data-order="asc">Status
                    </th>
                    <th style="cursor:pointer; width: 8rem;" class="sort" data-column="approval_status" data-order="asc">Approval</th>
                    <th style="cursor:pointer; width: 8rem;" class="sort" data-column="updated_at" data-order="desc">
                        Last Modified</th>
                    <th style="cursor:pointer; width: 10rem; text-align: end;">
                        <input type="text" id="search-input" placeholder="Search Name...">
                    </th>
                </tr>
            </thead>
            <tbody id="listings-tbody">
                @foreach ($listings as $listing)
                <tr>
                    <td style="max-width: 15rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        <a href="{{ route('listings.preview', $listing->id) }}">{{ $listing->location_name }}</a>
                    </td>
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
<!-- Script untuk mencari listing, mengubah status listing, mengurutkan tabel, dan download excel -->
<script>
    $(document).ready(function() {
        // Mencari listings
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

        // Handler untuk mengubah status listing
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

        // Function untuk mengurutkan tabel
        function sortTable(column, order) {
            var tbody = $('#listings-tbody');
            var rows = tbody.find('tr').toArray();

            rows.sort(function(a, b) {
                var aValue, bValue;

                // Get nilai dari masing-masing kolom untuk di urutkan
                switch (column) {
                    case 'name':
                        aValue = $(a).find('td').eq(0).text().trim();
                        bValue = $(b).find('td').eq(0).text().trim();
                        break;
                    case 'rating':
                        aValue = parseFloat($(a).find('td').eq(1).text());
                        bValue = parseFloat($(b).find('td').eq(1).text());
                        break;
                    case 'status':
                        aValue = $(a).find('td').eq(2).attr('data-status');
                        bValue = $(b).find('td').eq(2).attr('data-status');
                        break;
                    case 'approval_status':
                        aValue = $(a).find('td').eq(3).attr('data-approval-status');
                        bValue = $(b).find('td').eq(3).attr('data-approval-status');
                        break;
                    case 'updated_at':
                        aValue = parseInt($(a).find('td').eq(4).attr('data-date'));
                        bValue = parseInt($(b).find('td').eq(4).attr('data-date'));
                        break;
                    default:
                        break;
                }

                // Mengurutkan nilai pada kolom
                if (order === 'asc') {
                    return aValue > bValue ? 1 : -1;
                } else {
                    return aValue < bValue ? 1 : -1;
                }
            });

            // Membuat ulang baris berdasarkan hasil sorting
            tbody.empty().append(rows);
        }

        // Handler untuk event click pada kolom
        $('.sort').on('click', function() {
            var column = $(this).data('column');
            var order = $(this).data('order');

            // Handler untuk mengubah order
            if (order === 'asc') {
                $(this).data('order', 'desc');
            } else {
                $(this).data('order', 'asc');
            }

            // Membuang sort indicator pada kolom lain
            $(this).siblings().removeAttr('data-order');

            // Menambahkan sort indicator ke kolom yang sedang diurutkan
            $(this).attr('data-order', order === 'asc' ? 'desc' : 'asc');

            // Menugurutkan tabel
            sortTable(column, order);
        });

        // Download Excel
        document.getElementById('excel-user-listing').addEventListener('click', function() {
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.table_to_sheet(document.querySelector('.user-listings-table table'));
            XLSX.utils.book_append_sheet(wb, ws, 'Listings');
            XLSX.writeFile(wb, 'listings.xlsx');
        });
    });
</script>
@endsection