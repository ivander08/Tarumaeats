@extends('layouts.app')

@section('title', 'Admin dashboard - Users')

@section('content')
    <!-- Bagian header halaman -->
    <div class="user-listings-head">
        <!-- Bagian navigasi dan judul -->
        <div class="user-listings-head-text">
            <div class="user-listings-head-text-settings">
                <div class="vl-red"></div>
                <h1>Manage Users</h1>
            </div>
            <a href="{{ route('user') }}">My Details</a>
            <a href="{{ route('listings') }}">My Listings</a>
            @if (auth()->user()->is_admin)
                <a href="{{ route('admin.users') }}" style="font-weight: bold; text-decoration: underline;">Manage Users</a>
                <a href="{{ route('admin.listings') }}">Manage Listings</a>
            @endif
        </div>
        <button type="button" id="excel-user-listing" class="user-listings-excel">Download Excel</button>
    </div>
    <!-- Bagian tabel yang menampilkan daftar pengguna -->
    <div class="user-listings-table-wrapper">
        <div class="user-listings-table">
            <table>
                <thead>
                    <tr>
                        <th style="cursor:pointer; width: 15rem;" class="sort" data-column="name" data-order="asc">Name
                        </th>
                        <th style="cursor:pointer; width: 15rem;" class="sort" data-column="email" data-order="asc">Email
                        </th>
                        <th style="cursor:pointer; width: 5rem;" class="sort" data-column="created_at" data-order="asc">
                            Verified At</th>
                        <th style="cursor:pointer; width: 5rem;" class="sort" data-column="is_admin" data-order="asc">Role
                        </th>
                        <th style="cursor:pointer; width: 10rem; text-align: end;">
                            Action
                        </th>
                    </tr>
                </thead>
                <!-- Bagian ini menampilkan setiap pengguna dalam tabel -->
                <tbody id="listings-tbody">
                    @foreach ($user as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td data-date="{{ $user->created_at->timestamp }}">
                                {{ $user->created_at->diffForHumans() }}
                            </td>
                            <td data-admin="{{ $user->is_admin }}">
                                <div class="user-status-{{ $user->is_admin ? '1' : '0' }}" data-id="{{ $user->id }}"
                                    data-is_admin="{{ $user->is_admin }}">
                                    &#x2022;
                                    @if ($user->is_admin)
                                        Admin
                                    @else
                                        User
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="user-listings-table-interact">
                                    <form id="delete-form-{{ $user->id }}"
                                        action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="javascript:void(0);"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                        <img src="{{ asset('images/Trash.png') }}" alt="Delete" class="delete-button">
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}">
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
        // Fungsi untuk mengurutkan tabel berdasarkan kolom dan urutan yang dipilih
        function sortTable(column, order) {
            // console.log('Sorting by column:', column, 'Order:', order);
            var tbody = $('#listings-tbody');
            var rows = tbody.find('tr').toArray();
            rows.sort(function(a, b) {
                var aValue, bValue;
                switch (column) {
                    case 'name':
                        aValue = $(a).find('td').eq(0).text().trim();
                        bValue = $(b).find('td').eq(0).text().trim();
                        break;
                    case 'email':
                        aValue = $(a).find('td').eq(1).text().trim();
                        bValue = $(b).find('td').eq(1).text().trim();
                        break;
                    case 'created_at':
                        aValue = parseInt($(a).find('td').eq(2).attr('data-date'));
                        bValue = parseInt($(b).find('td').eq(2).attr('data-date'));
                        break;
                    case 'is_admin':
                        aValue = $(a).find('td').eq(3).attr('data-admin');
                        bValue = $(b).find('td').eq(3).attr('data-admin');
                        break;
                    default:
                        aValue = $(a).find('td').eq(column).text().toLowerCase();
                        bValue = $(b).find('td').eq(column).text().toLowerCase();
                        break;
                }
                // console.log('Comparing values:', aValue, bValue);
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

            // Handler untuk event click pada status pengguna untuk mengubah peran pengguna
            if (order === 'asc') {
                $(this).data('order', 'desc');
            } else {
                $(this).data('order', 'asc');
            }

            // Menghapus sort indicator dari kolom lain
            $(this).siblings().removeAttr('data-order');

            // Menambahkan sort indicator ke kolom yang sedang diurutkan
            $(this).attr('data-order', order === 'asc' ? 'desc' : 'asc');

            // Mengurutkan tabel
            sortTable(column, order);
        });

        $(document).ready(function() {
            $('#listings-tbody').on('click', '.user-status-0, .user-status-1', function() {
                var userId = $(this).data('id');
                var currentRole = $(this).data('is_admin');
                var newRole = !currentRole;

                $.ajax({
                    url: "{{ route('admin.user.updateRole') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: userId,
                        is_admin: newRole
                    },
                    success: function(response) {
                        location.reload(); // Memuat ulang halaman jika berhasil untuk memperlihatkan perubahan
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Error handling
                    }
                });
            });

            // Fungsi untuk mengunduh data tabel dalam format Excel
            document.getElementById('excel-user-listing').addEventListener('click', function() {
                var wb = XLSX.utils.book_new();
                var ws = XLSX.utils.table_to_sheet(document.querySelector('.user-listings-table table'));
                XLSX.utils.book_append_sheet(wb, ws, 'Users');
                XLSX.writeFile(wb, 'users.xlsx');
            });
        });
    </script>
@endsection
