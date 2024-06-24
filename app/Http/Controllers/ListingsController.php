<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listings;
use App\Models\ratings;
use Illuminate\Support\Facades\Storage;

class ListingsController extends Controller
{
    public function home()
    {
        $listings = listings::with('ratings')
            ->where('approval_status', 'approved')
            ->where('is_featured', true)
            ->get();

        return view("home", compact("listings"));
    }

    public function indexApproved(Request $request)
    {
        // Retrieve approved and online listings
        $listings = Listings::with('ratings')
            ->where('approval_status', 'approved')
            ->where('status', 'online')
            ->get();

        $resultsCount = $listings->count();

        // $listings = Listings::all();

        // Pass the filtered listings to the view
        return view('eats', compact('listings', 'resultsCount'));
    }

    public function filter(Request $request)
    {
        // Retrieve filter selections from the request
        $campus = $request->input('campus');
        $type = $request->input('type');
        $cuisine = $request->input('cuisine');
        $priceRange = $request->input('price_range');
        $paymentOptions = $request->input('payment_options');
        $specialFeatures = $request->input('special_features');
        $search = strtolower($request->input('search'));

        // // Debugging
        // echo '<pre>';
        // print_r($cuisine);
        // echo '</pre>';

        // echo '<pre>';
        // print_r($priceRange);
        // echo '</pre>';

        // Query builder for listings
        $query = Listings::query();

        // Apply filters
        if ($campus) {
            $query->where('campus', $campus);
        }

        if ($type) {
            $query->where('type', $type);
        }

        if ($cuisine) {
            $query->whereJsonContains('cuisine', $cuisine);
        }

        if ($priceRange) {
            // Idk how this logic works lol
            if (count($priceRange) === 4) {
            } else {
                $query->whereIn('price_range', $priceRange);
            }
        }

        if ($paymentOptions) {
            $query->whereJsonContains('payment_options', $paymentOptions);
        }

        if ($specialFeatures) {
            $query->whereJsonContains('special_features', $specialFeatures);
        }

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(location_name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(location_address) LIKE ?', ["%{$search}%"]);
            });
        }

        // Apply the condition for approved and online listings
        $query->where('approval_status', 'approved')->where('status', 'online');

        // Execute the query
        $listings = $query->get();

        // Pass the filtered listings to the view
        return view('eats', compact('listings'));
    }

    public function index()
    {
        $userName = auth()->user()->name;
        $listings = Listings::where('name', $userName)->get();
        return view('listings.userListings', compact('listings'));
    }

    public function create()
    {
        return view('listings.createListings');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'location_name' => 'required|string|max:255',
            'campus' => 'required|string|max:255',
            'location_address' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:30720',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:30720',
            'carousel_images' => 'required|array',
            'carousel_images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:30720',
            'type' => 'nullable|string|max:255',
            'cuisine' => 'required|array',
            'price_range' => 'required|string',
            'payment_options' => 'required|array',
            'special_features' => 'nullable|array',
        ]);

        $existingListing = Listings::where('location_name', $request->location_name)->first();

        if ($existingListing) {
            return redirect()->back()->withInput()->withErrors(['location_name' => 'Location name already exists.']);
        }

        // Handle the image file uploads and encode them as base64
        $mainImage = base64_encode(file_get_contents($request->file('main_image')->getRealPath()));
        $bannerImage = base64_encode(file_get_contents($request->file('banner_image')->getRealPath()));

        $carouselImages = [];
        foreach ($request->file('carousel_images') as $carouselImage) {
            $carouselImages[] = base64_encode(file_get_contents($carouselImage->getRealPath()));
        }

        // Generate a unique ID for the listing
        do {
            $listingId = random_int(1, PHP_INT_MAX);
        } while (Listings::find($listingId) !== null);

        // Create the listing
        Listings::create([
            'id' => $listingId,
            'name' => auth()->user()->name,
            'location_name' => $request->location_name,
            'campus' => $request->campus,
            'location_address' => $request->location_address,
            'website' => $request->website,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'main_image' => $mainImage,
            'banner_image' => $bannerImage,
            'carousel_images' => json_encode($carouselImages),
            'type' => $request->type,
            'cuisine' => json_encode($request->cuisine),
            'price_range' => $request->price_range,
            'payment_options' => json_encode($request->payment_options),
            'special_features' => json_encode($request->special_features),
        ]);

        return redirect()->route('listings');
    }



    public function edit($id)
    {
        $listing = Listings::find($id);
        return view('listings.editListings', compact('listing'));
    }

    public function update(Request $request, $id)
    {
        $listing = Listings::find($id);

        if (!$listing) {
            return redirect()->route('listings')->with('error', 'Listing not found.');
        }

        // Validate the form data
        $request->validate([
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

        // Update the listing attributes
        $listing->update([
            'name' => auth()->user()->name,
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

        return redirect()->route('listings');
    }


    public function destroy($id)
    {
        $listing = Listings::find($id);
        Storage::delete([$listing->main_image, $listing->banner_image]);
        foreach (json_decode($listing->carousel_images) as $carouselImage) {
            Storage::delete($carouselImage);
        }
        $listing->delete();
        return redirect()->route('listings');
    }

    public function show($id)
    {
        $listing = Listings::with('ratings')->findOrFail($id);

        // Check if the listing is approved or pending and online
        if (($listing->approval_status !== 'approved' && $listing->approval_status !== 'pending') || $listing->status !== 'online') {
            return redirect()->route('eats'); // Redirect to the eats page
        }

        if (auth()->check()) {
            $userRating = ratings::where([
                'name' => auth()->user()->name,
                'location_name' => $listing->location_name,
            ])->value('rating');

            return view('show', compact('listing', 'userRating'));
        }

        return view('show', compact('listing'));
    }


    // This one's kinda bruteforce... but it works
    public function search(Request $request)
    {
        $userName = auth()->user()->name;
        $search = strtolower($request->input('search'));

        $listings = Listings::where('name', $userName)
            ->whereRaw('LOWER(location_name) LIKE ?', ["%{$search}%"])
            ->get();

        return view('listings.partials.listingsTable', compact('listings'))->render();
    }


    public function updateStatus(Request $request)
    {
        $listing = Listings::find($request->id);

        if ($listing) {
            $listing->status = $request->status;
            $listing->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Listing not found'], 404);
    }

    public function preview($id)
    {
        $listing = Listings::with('ratings')->findOrFail($id);
        if (auth()->check()) {
            $userRating = ratings::where([
                'name' => auth()->user()->name,
                'location_name' => $listing->location_name,
            ])->value('rating');

            return view('listings.showPreview', compact('listing', 'userRating'));
        }
    }
}
