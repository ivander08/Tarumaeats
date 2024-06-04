<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\listings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'price_range' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'special_features' => 'nullable|array',
            'price_per_person' => 'nullable|string',
            'payment_options' => 'nullable|array',
            'open_hours' => 'nullable|string',
            'closed_hours' => 'nullable|string',
        ]);

        // Handle the image file upload
        $imageData = null;
        $image = $request->file('images');

        if ($image !== null) {
            // Read the image file and encode it as base64
            $imageData = base64_encode(file_get_contents($image->getRealPath()));
        }

        // Create the listing
        listings::create([
            'location_name' => $request->location_name,
            'location_address' => $request->location_address,
            'price_range' => $request->price_range,
            'website' => $request->website,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'images' => $imageData,
            'tags' => json_encode($request->tags),
            'special_features' => json_encode($request->special_features),
            'price_per_person' => $request->price_per_person,
            'payment_options' => json_encode($request->payment_options),
            'open_hours' => $request->open_hours,
            'closed_hours' => $request->closed_hours,
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

        $request->validate([
            'location_name' => 'required|string|max:255',
            'location_address' => 'required|string|max:255',
            'price_range' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'special_features' => 'nullable|array',
            'price_per_person' => 'nullable|string',
            'payment_options' => 'nullable|array',
            'open_hours' => 'nullable|string',
            'closed_hours' => 'nullable|string',
        ]);

        $imageData = null;
        $image = $request->file('images');

        if ($image !== null) {
            // Read the image file and encode it as base64
            $imageData = base64_encode(file_get_contents($image->getRealPath()));
        }

        listings::find($id)->update([
            'location_name' => $request->location_name,
            'location_address' => $request->location_address,
            'price_range' => $request->price_range,
            'website' => $request->website,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'images' => $imageData,
            'tags' => json_encode($request->tags),
            'special_features' => json_encode($request->special_features),
            'price_per_person' => $request->price_per_person,
            'payment_options' => json_encode($request->payment_options),
            'open_hours' => $request->open_hours,
            'closed_hours' => $request->closed_hours,
            ]);

        return redirect()-> route('listings');
    }

    public function destroy($id){
        $listing = listings::find($id);
        $listing->delete();
        return redirect()-> route('listings');
    }
}
