<?php

use App\Http\Controllers\ListingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/eats', function () {
        return view('eats');
    })->name('eats');

    Route::get('/user/listings', function () {
        return view('listings/userListings');
    })->name('userListings');

    Route::get('/user/listings/createListings', function () {
        return view('listings/createListings');
    })->name('createListings');

    Route::get('/listings', [ListingsController::class, 'index'])->name('listings');
    route::get('/listings/edit/{id}', [ListingsController::class, 'edit'])->name('listings.edit');
    Route::get('/listings/create', [ListingsController::class, 'create'])->name('listings.create');
    Route::post('/listings/store', [ListingsController::class, 'store'])->name('listings.store');
    Route::put('/listings/update/{id}', [ListingsController::class, 'update'])->name('listings.update');
    Route::delete('/listings/destroy/{id}', [ListingsController::class, 'destroy'])->name('listings.destroy');


    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
