<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ratings;

class RatingsController extends Controller
{
    // Fungsi store digunakan untuk menyimpan data rating
    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $existingRating = Ratings::where([
            'name' => auth()->user()->name,
            'location_name' => $request->location_name,
        ])->first();

        if ($existingRating && $existingRating->rating == $request->rating) {
            $existingRating->delete();
        } else {
            if ($existingRating) {
                $existingRating->update(['rating' => $request->rating]);
            } else {
                do {
                    $ratingId = random_int(1, PHP_INT_MAX);
                } while (Ratings::find($ratingId) !== null);
                Ratings::create([
                    'id' => $ratingId,
                    'name' => auth()->user()->name,
                    'location_name' => $request->location_name,
                    'rating' => $request->rating,
                ]);
            }
        }

        return redirect()->back();
    }
}
