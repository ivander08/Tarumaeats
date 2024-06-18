<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\listings;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function usersIndex()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $user = User::all()->sortBy('id');
            return view('admin.usersIndex', compact('user'));
        }
        return redirect('/');
    }

    public function listingsIndex()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $listings = listings::all()->sortBy('id');
            return view('admin.listingsIndex', compact('listings'));
        }
        return redirect('/');
    }

    public function editListing($id)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $listing = Listings::find($id);
            return view('admin.adminEditListings', compact('listing'));
        }
        return redirect('/');
    }

    public function updateStatus(Request $request)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $listing = Listings::find($request->id);
            $listing->status = $request->status;
            $listing->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    public function updateApproval(Request $request)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $listing = Listings::find($request->id);

            if ($listing) {
                $listing->approval_status = $request->status;
                $listing->save();

                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    public function updateFeatured(Request $request)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $listing = Listings::find($request->id);

            if ($listing) {
                $listing->is_featured = $request->is_featured;
                $listing->save();

                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    public function updateRole(Request $request)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $user = User::find($request->id);

            if ($user) {
                $user->is_admin = $request->is_admin;
                $user->save();

                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    public function show($id)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $listing = listings::find($id);
            return view('admin.showPreview', compact('listing'));
        }
        return redirect('/');
    }

    public function destroyUser(User $user)
    {
        // Delete the user and any associated data (if needed)
        $user->delete();

        // Redirect back to the admin dashboard with a success message
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function editUser(User $user)
    {
        // Load the edit user view with the user data
        return view('user.adminDetails', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update user details
        $originalUsername = $user->name;
        Listings::where('name', $originalUsername)->update(['name' => $user->name]);
        $user->name = $request->input('username');
        $user->email = $request->input('email');
        $user->save();

        // Redirect back to the admin dashboard with a success message
        return redirect()->route('admin.users')->with('success', 'User details updated successfully.');
    }
}
