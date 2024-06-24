<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listings;
use App\Models\ratings;
use Illuminate\Support\Facades\Storage;

// Kelas ListingsController mengendalikan logika bisnis untuk daftar listing
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
        $listings = Listings::with('ratings')
            ->where('approval_status', 'approved')
            ->where('status', 'online')
            ->get();

        $resultsCount = $listings->count();

        return view('eats', compact('listings', 'resultsCount'));
    }

    public function filter(Request $request)
    {
        $campus = $request->input('campus');
        $type = $request->input('type');
        $cuisine = $request->input('cuisine');
        $priceRange = $request->input('price_range');
        $paymentOptions = $request->input('payment_options');
        $specialFeatures = $request->input('special_features');
        $search = strtolower($request->input('search'));

        $query = Listings::query();

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

        $query->where('approval_status', 'approved')->where('status', 'online');

        $listings = $query->get();

        return view('eats', compact('listings'));
    }

    // Fungsi index mengambil semua listing dari database dan menampilkannya
    public function index()
    {
        $userName = auth()->user()->name;
        $listings = Listings::where('name', $userName)->get();
        return view('listings.userListings', compact('listings'));
    }

    // Fungsi create menampilkan form untuk membuat listing baru
    public function create()
    {
        return view('listings.createListings');
    }

    // Fungsi store menyimpan listing baru ke dalam database
    public function store(Request $request)
    {
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

        $mainImage = base64_encode(file_get_contents($request->file('main_image')->getRealPath()));
        $bannerImage = base64_encode(file_get_contents($request->file('banner_image')->getRealPath()));

        $carouselImages = [];
        foreach ($request->file('carousel_images') as $carouselImage) {
            $carouselImages[] = base64_encode(file_get_contents($carouselImage->getRealPath()));
        }

        do {
            $listingId = random_int(1, PHP_INT_MAX);
        } while (Listings::find($listingId) !== null);
        // Create a new listing instance
        $listing = new Listings;
        $listing->id = $listingId;
        $listing->name = auth()->user()->name;
        $listing->location_name = $request->location_name;
        $listing->campus = $request->campus;
        $listing->location_address = $request->location_address;
        $listing->website = $request->website;
        $listing->phone_number = $request->phone_number;
        $listing->email = $request->email;
        $listing->main_image = $mainImage;
        $listing->banner_image = $bannerImage;
        $listing->carousel_images = json_encode($carouselImages);
        $listing->type = $request->type;
        $listing->cuisine = json_encode($request->cuisine);
        $listing->price_range = $request->price_range;
        $listing->payment_options = json_encode($request->payment_options);
        $listing->special_features = json_encode($request->special_features);

        $listing->save();

        return redirect()->route('listings');
    }

    // Fungsi edit menampilkan form untuk mengedit sebuah listing
    public function edit($id)
    {
        $listing = Listings::find($id);
        return view('listings.editListings', compact('listing'));
    }

    // Fungsi update mengupdate sebuah listing di dalam database
    public function update(Request $request, $id)
    {
        $listing = Listings::find($id);

        if (!$listing) {
            return redirect()->route('listings')->with('error', 'Listing not found.');
        }

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

    // Fungsi destroy menghapus sebuah listing dari database
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

    // Fungsi show menampilkan detail dari sebuah listing
    public function show($id)
    {
        $listing = Listings::with('ratings')->findOrFail($id);

        if (($listing->approval_status !== 'approved' && $listing->approval_status !== 'pending') || $listing->status !== 'online') {
            return redirect()->route('eats');
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
