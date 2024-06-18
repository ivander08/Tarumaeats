<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\listings;
use App\Models\ratings;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $listings = listings::with('ratings')->orderBy('created_at')->get();
        return view("eats", compact("listings"));
    }
    
    public function show()
    {
        return view("user.userDetails");
    }
}
