<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\listings;
use App\Models\User;
use App\Models\ratings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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

    public function updateListing(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $listing = Listings::find($id);

            if (!$listing) {
                return redirect()->route('listings')->with('error', 'Listing not found.');
            }

            // Validate the form data
            $request->validate([
                'name' => 'required|string|max:255',
                'location_name' => 'required|string|max:255',
                'campus' => 'required|string|max:255',
                'location_address' => 'required|string|max:255',
                'website' => 'nullable|string|max:255',
                'phone_number' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|max:255',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:30720',
                'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:30720',
                'carousel_images' => 'nullable|array',
                'carousel_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:30720',
                'type' => 'nullable|string|max:255',
                'cuisine' => 'required|array',
                'price_range' => 'required|string',
                'payment_options' => 'required|array',
                'special_features' => 'nullable|array',
            ]);

            $user = User::where('name', $request->name)->first();

            if (!$user) {
                return redirect()->route('admin.listings.edit', ['id' => $id])->withErrors(['name' => 'User not found.']);
            }

            // Update the listing attributes
            $listing->update([
                'name' => $request->name,
                'location_name' => $request->location_name,
                'campus' => $request->campus,
                'location_address' => $request->location_address,
                'website' => $request->website,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'type' => $request->type,
                'cuisine' => json_encode($request->cuisine),
                'price_range' => $request->price_range,
                'payment_options' => json_encode($request->payment_options),
                'special_features' => json_encode($request->special_features),
            ]);

            // Handle image updates
            if ($request->hasFile('main_image')) {
                Storage::delete($listing->main_image);
                $listing->main_image = base64_encode(file_get_contents($request->file('main_image')->getRealPath()));
            }

            if ($request->hasFile('banner_image')) {
                Storage::delete($listing->banner_image);
                $listing->banner_image = base64_encode(file_get_contents($request->file('banner_image')->getRealPath()));
            }

            if ($request->hasFile('carousel_images')) {
                $carouselImages = [];
                foreach ($request->file('carousel_images') as $carouselImage) {
                    $carouselImages[] = base64_encode(file_get_contents($carouselImage->getRealPath()));
                }
                Storage::delete(json_decode($listing->carousel_images));
                $listing->carousel_images = json_encode($carouselImages);
            }

            $listing->save();

            return redirect()->route('admin.listings');
        }
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
            $listing = Listings::with('ratings')->findOrFail($id);
            $userRating = ratings::where([
                'name' => auth()->user()->name,
                'location_name' => $listing->location_name,
            ])->value('rating');
            return view('admin.showPreview', compact('listing', 'userRating'));
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
