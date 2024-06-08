<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listings;
use Illuminate\Support\Facades\Storage;

class ListingsController extends Controller
{
    public function index()
    {
        $listings = Listings::all();
        return view('listings.index', compact('listings'));
    }

    public function create()
    {
        return view('listings.create');
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
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
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

        // Handle the image file uploads and encode them as base64
        $mainImage = base64_encode(file_get_contents($request->file('main_image')->getRealPath()));
        $bannerImage = base64_encode(file_get_contents($request->file('banner_image')->getRealPath()));

        $carouselImages = [];
        foreach ($request->file('carousel_images') as $carouselImage) {
            $carouselImages[] = base64_encode(file_get_contents($carouselImage->getRealPath()));
        }

        // Create the listing
        Listings::create([
            'name' => auth()->user()->name,
            'location_name' => $request->location_name,
            'campus' => $request->campus,
            'location_address' => $request->location_address,
            'website' => $request->website,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
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
        return view('listings.edit', compact('listing'));
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
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
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
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
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
}
