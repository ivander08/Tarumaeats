<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingsController;

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
    return view('welcome');
});

// Temporary routes
Route::get('/eats', function () {
    return view('eats');
})->name('eats');

Route::get('/user/listings', function () {
    return view('userListings');
})->name('userListings');

Route::get('/layout', function () {
    return view('layout');
})->name('layout');

Route::get('/listings', [ListingsController::class, 'index'])->name('listings');
route::get('/listings/edit/{id}', [ListingsController::class, 'edit'])->name('listings.edit');
Route::get('/listings/create', [ListingsController::class, 'create'])->name('listings.create');
Route::post('/listings/store', [ListingsController::class, 'store'])->name('listings.store');
Route::put('/listings/update/{id}', [ListingsController::class, 'update'])->name('listings.update');
Route::delete('/listings/destroy/{id}', [ListingsController::class, 'destroy'])->name('listings.destroy');