<?php

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
    return view('welcome');
});

// Temporary routes
Route::get('/eats', function () {
    return view('eats');
})->name('eats');

Route::get('/user/listings', function () {
    return view('listings/userListings');
})->name('userListings');

Route::get('/user/listings/createListings', function () {
    return view('listings/createListings');
})->name('createListings');

Route::get('/layout', function () {
    return view('layout');
})->name('layout');