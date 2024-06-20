@extends('layouts.app')

@section('title', 'Admin dashboard - Users')

@section('content')
    <div class="user-listings-head">
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
    </div>
    <div class="user-listings-table-wrapper">
        <div class="user-listings-table">
            <table>
                <thead>
                    <tr>
                        <th style="cursor:pointer; width: 15rem;" class="sort" data-column="name" data-order="asc">Name
                        </th>
                        <th style="cursor:pointer; width: 15rem;" class="sort" data-column="email" data-order="asc">Email
                        </th>
                        <th style="cursor:pointer; width: 5rem;" class="sort" data-column="email_verified_at"
                            data-order="asc">Verified At</th>
                        <th style="cursor:pointer; width: 5rem;" class="sort" data-column="is_admin" data-order="asc">Role
                        </th>
                        <th style="cursor:pointer; width: 10rem; text-align: end;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="listings-tbody">
                    @foreach ($user as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
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
        function sortTable(column, order) {
            var tbody = $('#listings-tbody');
            var rows = tbody.find('tr').toArray();

            rows.sort(function(a, b) {
                var aValue, bValue;

                // Get column values for sorting
                switch (column) {
                    case 0: // For the "Name" column
                        aValue = $(a).find('td').eq(column).text().toLowerCase();
                        bValue = $(b).find('td').eq(column).text().toLowerCase();
                        break;
                    case 1: // For the "Email" column
                        aValue = $(a).find('td').eq(column).text().toLowerCase();
                        bValue = $(b).find('td').eq(column).text().toLowerCase();
                        break;
                    case 2: // For the "Verified At" column
                        aValue = new Date($(a).find('td').eq(column).text());
                        bValue = new Date($(b).find('td').eq(column).text());
                        break;
                    case 3: // For the "Role" column
                        aValue = $(a).find('td').eq(column).find('div').data('is_admin') ? 'admin' : 'user';
                        bValue = $(b).find('td').eq(column).find('div').data('is_admin') ? 'admin' : 'user';
                        break;
                    default:
                        aValue = $(a).find('td').eq(column).text().toLowerCase();
                        bValue = $(b).find('td').eq(column).text().toLowerCase();
                        break;
                    }

                    // Perform sorting based on column values
                    if (order === 'asc') {
                        return aValue > bValue ? 1 : -1;
                    } else {
                        return aValue < bValue ? 1 : -1;
                    }
                });

                // Rebuild the table with sorted rows
                tbody.empty().append(rows);
            }

        // Click event for sorting table
        $('.sort').on('click', function() {
            var column = $(this).data('column');
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

        $(document).ready(function() {
            $('.user-status-0, .user-status-1').on('click', function() {
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
                        location.reload(); // Reload the page on success to reflect changes
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle errors here, if necessary
                    }
                });
            });
        });
    </script>
@endsection
