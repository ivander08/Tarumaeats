<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ratings;

class RatingsController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'location_name' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Check if the user has already rated the location
        $existingRating = Ratings::where([
            'name' => auth()->user()->name,
            'location_name' => $request->location_name,
        ])->first();

        // If the user has already rated, update the rating; otherwise, create a new one
        if ($existingRating) {
            $existingRating->update(['rating' => $request->rating]);
        } else {
            Ratings::create([
                'name' => auth()->user()->name,
                'location_name' => $request->location_name,
                'rating' => $request->rating,
            ]);
        }

        return redirect()->back();
    }
}
