@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<!-- Bagian untuk menampilkan detail user -->
    <div class="user-listings-head">
        <div class="user-listings-head-text">
            <div class="user-listings-head-text-settings">
                <div class="vl-red"></div>
                <h1>User Details</h1>
            </div>
            <a href="{{ route('user') }}" style="font-weight: bold; text-decoration: underline;">My Details</a>
            <a href="{{ route('listings') }}">My Listings</a>
            @if (auth()->user()->is_admin)
                <a href="{{ route('admin.users') }}">Manage Users</a>
                <a href="{{ route('admin.listings') }}">Manage Listings</a>
            @endif
        </div>
        <div class="user-log-delete-container">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="user-save">Log Out</button>
            </form>
            
            <form action="{{ route('user.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="user-save">Delete Account</button>
            </form>
        </div>
    </div>
    <div class="user-details-form-wrapper">
        <form id="user-details-form" action="{{ route('user.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="user-details-text-forms-container">
                <h1>User Information</h1>
                <div class="user-details-text-forms">
                    <div class="user-details-form-group">
                        <label for="username">Username</label>
                        <input type="text" class="user-details-form-control" id="username" name="username"
                            value="{{ auth()->user()->name }}" required>
                    </div>

                    <div class="user-details-form-group">
                        <label for="email">Email</label>
                        <input type="email" class="user-details-form-control" id="email" name="email"
                            value="{{ auth()->user()->email }}" required>
                    </div>

                    <div class="user-details-form-group">
                        <label for="password">Current Password</label>
                        <input type="password" class="user-details-form-control" id="currentPassword"
                            name="currentPassword">
                    </div>

                    <div class="user-details-form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="user-details-form-control" id="newPassword" name="newPassword">
                    </div>

                    <div class="user-details-form-group">
                        <label for="password">Confirm New Password</label>
                        <input type="password" class="user-details-form-control" id="newPassword_confirmation"
                            name="newPassword_confirmation">
                    </div>
                </div>
            </div>

            <div class="user-details-save-container">
                <div class="alert alert-danger">
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <button type="submit" class="user-save">Save</button>
            </div>
        </form>

    </div>
@endsection
