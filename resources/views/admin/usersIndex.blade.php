@extends('layouts.app')

@section('title', 'Admin dashboard - Users')

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
    </div>
    <div class="user-listings-table-wrapper">
        <div class="user-listings-table">
            <table>
                <thead>
                    <tr>
                        <th style="cursor:pointer; width: 15rem;" class="sort" data-column="name" data-order="asc">Name</th>
                        <th style="cursor:pointer; width: 15rem;" class="sort" data-column="email" data-order="asc">Email</th>
                        <th style="cursor:pointer; width: 5rem;" class="sort" data-column="email_verified_at" data-order="asc">Verified At</th>
                        <th style="cursor:pointer; width: 5rem;" class="sort" data-column="is_admin" data-order="asc">Role</th>
                        <th style="cursor:pointer; width: 10rem; text-align: end;">
                            <input type="text" id="search-input" placeholder="Search Name...">
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
                                <div class="user-status-{{ $user->is_admin ? '1' : '0' }}" 
                                     data-id="{{ $user->id }}" 
                                     data-is_admin="{{ $user->is_admin }}">
                                    &#x2022;
                                    @if ($user->is_admin)
                                        Admin
                                    @else
                                        User
                                    @endif
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
