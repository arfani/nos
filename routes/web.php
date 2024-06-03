<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// CLIENT ROUTES
Route::get('/', function () {
    return view('client.index');
})->name('client.home');

Route::get('/notification', function () {
    return view('client.notification.index');
})->name('client.notification');

Route::get('/cart', function () {
    return view('client.cart.index');
})->name('client.cart');

Route::get('/profile', function () {
    return view('client.profile.index');
})->name('client.profile');


// ADMIN ROUTES
Route::prefix('admin')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin.dashboard');
    });

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

Route::get('testing', function(){
    return view('testing');
});