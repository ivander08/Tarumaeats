@extends('layouts.app')

@section('title', 'User Details')

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
                <a href="#">Manage Users</a>
                <a href="#">Manage Listings</a>
            @endif
        </div>
    </div>
    <div class="user-details-form-wrapper">
        <form id="user-details-form">
            <div class="user-details-text-forms-container">
                <h1>User Information</h1>
                <div class="user-details-text-forms">
                    <div class="user-details-form-group">
                        <label for="username">Username</label>
                        <input type="text" class="user-details-form-control" id="username" name="username" value="{{ auth()->user()->name }}" required>
                    </div>

                    <div class="user-details-form-group">
                        <label for="email">Email</label>
                        <input type="email" class="user-details-form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                    </div>

                    <div class="user-details-form-group">
                        <label for="password">Password</label>
                        <input type="password" class="user-details-form-control" id="password" name="password">
                        <small>Leave blank if you don't want to change the password</small>
                    </div>
                </div>
            </div>

            <div class="user-details-save-container">
                <button type="submit" class="user-details-save">Update Details</button>
            </div>
        </form>
    </div>
@endsection
