<?php

use App\Http\Controllers\ListingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\AdminController;
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
})->name('home');

Route::get('/', [ListingsController::class, 'home'])->name('home');
Route::get('/eats', [ListingsController::class, 'indexApproved'])->name('eats');
Route::post('/eats/filter', [ListingsController::class, 'filter'])->name('eats.filter');
Route::get('/eats/{id}', [ListingsController::class, 'show'])->name('eats.show');
Route::post('/ratings/store', [RatingsController::class, 'store'])->name('ratings.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/details', [UserController::class, 'show'])->name('user');
    Route::put('/user/details/update', [UserController::class, 'update'])->name('user.update');

    Route::get('/user/listings', [ListingsController::class, 'index'])->name('listings');
    Route::get('/user/listings/create', [ListingsController::class, 'create'])->name('listings.create');
    route::get('user/listings/edit/{id}', [ListingsController::class, 'edit'])->name('listings.edit');
    Route::post('user/listings/store', [ListingsController::class, 'store'])->name('listings.store');
    Route::put('user/listings/update/{id}', [ListingsController::class, 'update'])->name('listings.update');
    Route::delete('user/listings/destroy/{id}', [ListingsController::class, 'destroy'])->name('listings.destroy');
    Route::get('user/listings/search', [ListingsController::class, 'search'])->name('listings.search');
    Route::post('user/listings/updateStatus', [ListingsController::class, 'updateStatus'])->name('listings.updateStatus');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/listings', [AdminController::class, 'listingsIndex'])->name('admin.listings');
    Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name('admin.users');
    Route::post('/admin/listings/updateStatus', [AdminController::class, 'updateStatus'])->name('admin.listings.updateStatus');
    Route::post('/admin/listings/updateApproval', [AdminController::class, 'updateApproval'])->name('admin.listings.updateApproval');
    Route::post('/admin/listings/updateFeatured', [AdminController::class, 'updateFeatured'])->name('admin.listings.updateFeatured');
    Route::post('/admin/users/updateRole', [AdminController::class, 'updateRole'])->name('admin.user.updateRole');
    Route::get('/admin/listings/preview/{id}', [AdminController::class, 'show'])->name('admin.preview');
});

require __DIR__ . '/auth.php';
