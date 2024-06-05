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
        <button type="create" class="user-listings-create">Create Listing</button>
    </div>
    <div class="user-listings-table">
        <table>
            <thead>
                <th style="width: 20rem;">Name</th>
                <th style="width: 5rem;">Rating</th>
                <th style="width: 5rem;">Status</th>
                <th style="width: 8rem;">Approval</th>
                <th style="width: 8rem;">Last Modified</th>
                <th style="width: 10rem; text-align: end;">
                    <input type="text" placeholder="Search Name...">
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>DLS CKN</td>
                    <td>5.0 (3)</td>
                    <td>
                        <div class="listing-status-active">
                            &#x2022; Active
                        </div>
                    </td>
                    <td>
                        <div class="listing-status-approved">
                            &#x2022; Approved
                        </div>
                    </td>
                    <td>3 minutes ago</td>
                    <td>
                        <div class="user-listings-table-interact">
                            <img src="{{ asset('images/Trash.png') }}" alt="Delete" class="delete-button">
                            <img src="{{ asset('images/Edit.png') }}" alt="Edit" class="edit-button">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
