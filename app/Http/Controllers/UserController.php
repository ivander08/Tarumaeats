<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\listings;

class UserController extends Controller
{
    public function index()
    {
       $listings =listings::orderBy("created_at")->get();
       return view("eats", compact("listings"));
    }
}
