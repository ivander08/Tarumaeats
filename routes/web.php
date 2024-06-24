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

ini_set('memory_limit', '2048M');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/', [ListingsController::class, 'home'])->name('home'); // Rute untuk halaman utama
Route::get('/eats', [ListingsController::class, 'indexApproved'])->name('eats'); // Rute untuk menampilkan listing yang telah disetujui
Route::post('/eats/filter', [ListingsController::class, 'filter'])->name('eats.filter'); // Rute untuk melakukan filter pada listing
Route::get('/eats/{id}', [ListingsController::class, 'show'])->name('eats.show'); // Rute untuk menampilkan detail listing
Route::post('/ratings/store', [RatingsController::class, 'store'])->name('ratings.store'); // Rute untuk menyimpan rating

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); // Rute untuk halaman dashboard, memerlukan autentikasi dan verifikasi

Route::middleware('auth')->group(function () {
    Route::get('/user/details', [UserController::class, 'show'])->name('user'); // Rute untuk menampilkan detail pengguna
    Route::put('/user/details/update', [UserController::class, 'update'])->name('user.update'); // Rute untuk memperbarui detail pengguna
    Route::delete('/user/details/delete', [UserController::class, 'delete'])->name('user.delete'); // Rute untuk menghapus pengguna
    

    Route::get('/user/listings', [ListingsController::class, 'index'])->name('listings'); // Rute untuk menampilkan semua listing pengguna
    Route::get('/user/listings/create', [ListingsController::class, 'create'])->name('listings.create'); // Rute untuk membuat listing baru
    Route::get('user/listings/edit/{id}', [ListingsController::class, 'edit'])->name('listings.edit'); // Rute untuk mengedit listing
    Route::post('user/listings/store', [ListingsController::class, 'store'])->name('listings.store'); // Rute untuk menyimpan listing baru
    Route::put('user/listings/update/{id}', [ListingsController::class, 'update'])->name('listings.update'); // Rute untuk memperbarui listing
    Route::delete('user/listings/destroy/{id}', [ListingsController::class, 'destroy'])->name('listings.destroy'); // Rute untuk menghapus listing
    Route::get('user/listings/search', [ListingsController::class, 'search'])->name('listings.search'); // Rute untuk mencari listing
    Route::post('user/listings/updateStatus', [ListingsController::class, 'updateStatus'])->name('listings.updateStatus'); // Rute untuk memperbarui status listing
    Route::get('/user/listings/preview/{id}', [ListingsController::class, 'preview'])->name('listings.preview'); // Rute untuk preview listing
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/listings', [AdminController::class, 'listingsIndex'])->name('admin.listings'); // Rute untuk menampilkan semua listing di halaman admin
    Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name('admin.users'); // Rute untuk menampilkan semua pengguna di halaman admin
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit'); // Rute untuk mengedit pengguna di halaman admin
    Route::put('/admin/users/{user}/update', [AdminController::class, 'updateUser'])->name('admin.users.update'); // Rute untuk memperbarui pengguna di halaman admin
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy'); // Rute untuk menghapus pengguna di halaman admin
    Route::get('admin/listings/edit/{id}', [AdminController::class, 'editListing'])->name('admin.listings.edit'); // Rute untuk mengedit listing di halaman admin
    Route::put('admin/listings/update/{id}', [AdminController::class, 'updateListing'])->name('admin.listings.update'); // Rute untuk memperbarui listing di halaman admin
    Route::post('/admin/listings/updateStatus', [AdminController::class, 'updateStatus'])->name('admin.listings.updateStatus'); // Rute untuk memperbarui status listing di halaman admin
    Route::post('/admin/listings/updateApproval', [AdminController::class, 'updateApproval'])->name('admin.listings.updateApproval'); // Rute untuk memperbarui status persetujuan listing di halaman admin
    Route::post('/admin/listings/updateFeatured', [AdminController::class, 'updateFeatured'])->name('admin.listings.updateFeatured'); // Rute untuk memperbarui status featured listing di halaman admin
    Route::post('/admin/users/updateRole', [AdminController::class, 'updateRole'])->name('admin.user.updateRole'); // Rute untuk memperbarui peran pengguna di halaman admin
    Route::get('/admin/listings/preview/{id}', [AdminController::class, 'show'])->name('admin.preview'); // Rute untuk preview listing di halaman admin
});

require __DIR__ . '/auth.php';
