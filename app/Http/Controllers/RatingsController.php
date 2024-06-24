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
                // Generate a unique ID for the rating
                do {
                    $ratingId = random_int(1, PHP_INT_MAX);
                } while (Ratings::find($ratingId) !== null);

                $rating = new Ratings;
                $rating->id = $ratingId;
                $rating->name = auth()->user()->name;
                $rating->location_name = $request->location_name;
                $rating->rating = $request->rating;
                
                $rating->save();
            }
        }

        return redirect()->back();
    }
}
