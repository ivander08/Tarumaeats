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

        // If the user has already rated and the new rating is the same, delete the rating
        if ($existingRating && $existingRating->rating == $request->rating) {
            $existingRating->delete();
        } else {
            // If the user has already rated but the new rating is different, update the rating
            if ($existingRating) {
                $existingRating->update(['rating' => $request->rating]);
            } else {
                // If the user has not rated yet, create a new rating
                Ratings::create([
                    'name' => auth()->user()->name,
                    'location_name' => $request->location_name,
                    'rating' => $request->rating,
                ]);
            }
        }

        return redirect()->back();
    }
}
