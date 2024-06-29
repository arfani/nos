<?php

use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// CLIENT ROUTES
Route::get('/', [ClientController::class, 'home'])->name('client.home');

Route::get('/notification', function () {
    return view('client.notification.index');
})->name('client.notification');

Route::get('/cart', function () {
    return view('client.cart.index');
})->name('client.cart');

Route::get('/profile', function () {
    return view('client.profile.index');
})->name('client.profile')->middleware('auth');

Route::get('/promo', function () {
    return view('client.promo.index');
})->name('client.promo');

Route::get('/lelang', function () {
    return view('client.lelang.index');
})->name('client.lelang');

Route::get('/products', function () {
    return view('client.product.index');
})->name('client.products');

Route::get('/product/{product_id}', function () {
    return view('client.product.detail');
})->name('client.product');

Route::get('/page/{name}', function ($name) {
    return view('client.pages.index', compact('name'));
})->name('client.pages');


// ADMIN ROUTES
Route::prefix('admin')
    ->middleware(['auth', 'verified', 'can:is-admin'])
    ->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin.dashboard');

        Route::resource('notice', NoticeController::class)->only('index', 'update');
        Route::resource('faq', FaqController::class)->except('show');
        Route::resource('brand', BrandController::class);

        Route::get('profile', [AdminProfileController::class, 'index'])->name('admin-profile.index');
        Route::get('member', [MemberController::class, 'index'])->name('admin-member.index');
        Route::get('member/{user}', [MemberController::class, 'show'])->name('admin-member.show');
        Route::put('member-banned/{user}', [MemberController::class, 'ban'])->name('admin-member.ban');
        Route::put('member-unbanned/{user}', [MemberController::class, 'unban'])->name('admin-member.unban');
        
            //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
                Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
                Route::post('/update-photo', [ProfileController::class, 'update_photo'])->name('profile.update_photo');
            //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
            
        });
require __DIR__ . '/auth.php';

Route::get('testing', function(){
    return view('testing');
});