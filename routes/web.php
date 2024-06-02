<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// CLIENT ROUTES
Route::get('/', function () {
    return view('client.index');
})->name('client.home');

// ADMIN ROUTES
Route::prefix('admin')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin.dashboard');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('testing', function(){
    return view('testing');
});