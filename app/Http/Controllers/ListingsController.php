<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\listings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ListingsController extends Controller
{
    public function index()
    {
        $listings = listings::all();
        return view('listings.index', compact('listings'));
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request){

        // dd($request->all());

         // Validate the form data
         $request->validate([
            'location_name' => 'required|string|max:255',
            'location_address' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:30720',
            'type' => 'nullable|string|max:255',
            'cuisine' => 'nullable|array',
            'price_range' => 'required|string',
            'payment_options' => 'required|array',
            'special_features' => 'nullable|array',
        ]);

        // dd($request->all());

        // Handle the image file upload
        $imageData = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Read the image file and encode it as base64
                $imageData[] = base64_encode(file_get_contents($image->getRealPath()));
            }
        }

        // Create the listing
        listings::create([
            'name' => $request->name,
            'location_name' => $request->location_name,
            'location_address' => $request->location_address,
            'website' => $request->website,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'images' => json_encode($imageData),
            'type' => $request->type,
            'cuisine' => json_encode($request->cuisine),
            'price_range' => $request->price_range,
            'payment_options' => json_encode($request->payment_options),
            'special_features' => json_encode($request->special_features),
        ]);

        return redirect()-> route('listings');
    }

    public function edit($id){
        $listing = listings::find($id);
        $tags = explode(',', $listing->tags);
        return view('listings.edit', compact('listing'));
    }

    public function update(Request $request, $id){
        $listing = listings::find($id);

        if (!$listing) {
            return redirect()->route('listings')->with('error', 'Listing not found.');
        }
    
        $request->validate([
            'location_name' => 'required|string|max:255',
            'location_address' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:30720',
            'type' => 'nullable|string|max:255',
            'cuisine' => 'nullable|array',
            'price_range' => 'required|string',
            'payment_options' => 'required|array',
            'special_features' => 'nullable|array',
        ]);
    
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $index) {
                $images = json_decode($listing->images, true);
                $imageUrl = $images[$index];
                Storage::delete($imageUrl);
                unset($images[$index]);
            }
            $listing->images = json_encode(array_values($images));
            $listing->save();
        }
    
        $imageData = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageData[] = base64_encode(file_get_contents($image->getRealPath()));
            }
            $existingImages = json_decode($listing->images, true);
            $mergedImages = array_merge($existingImages ?? [], $imageData);
            $listing->images = json_encode($mergedImages);
            $listing->save();
        }
    
        // Update the listing attributes
        $listing->update([
            'name' => $request->name,
            'location_name' => $request->location_name,
            'location_address' => $request->location_address,
            'website' => $request->website,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'images' => json_encode($imageData),
            'type' => $request->type,
            'cuisine' => json_encode($request->cuisine),
            'price_range' => $request->price_range,
            'payment_options' => json_encode($request->payment_options),
            'special_features' => json_encode($request->special_features),
        ]);
    
        return redirect()->route('listings');
}


    public function destroy($id){
        $listing = listings::find($id);
        $listing->delete();
        return redirect()-> route('listings');
    }
}
