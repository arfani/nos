<?php

use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Client\PageController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\TestimonialController;
use App\Models\Feature;
use App\Models\Page;
use App\Models\Sosmed;
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
    $sosmed = Sosmed::all();
    return view('client.profile.index', compact('sosmed'));
})->name('client.profile')->middleware('auth');

Route::get('/promo', function () {
    $sosmed = Sosmed::all();
    $features = Feature::all();
    
    return view('client.promo.index', compact('sosmed', 'features'));
})->name('client.promo');

Route::get('/lelang', function () {
    $sosmed = Sosmed::all();
    $features = Feature::all();

    return view('client.lelang.index', compact('sosmed', 'features'));
})->name('client.lelang');

Route::get('/products', function () {
    $sosmed = Sosmed::all();

    return view('client.product.index', compact('sosmed'));
})->name('client.products');

Route::get('/product/{product_id}', function () {
    $sosmed = Sosmed::all();
    $features = Feature::all();

    return view('client.product.detail', compact('sosmed', 'features'));
})->name('client.product');

Route::get('/how-to-order',[PageController::class, 'howToOrder'])->name('client.how-to-order');
Route::get('/how-to-return',[PageController::class, 'howToReturn'])->name('client.how-to-return');
Route::get('/payment-method',[PageController::class, 'paymentMethod'])->name('client.payment-method');
Route::get('/about-us',[PageController::class, 'aboutUs'])->name('client.about-us');
Route::get('/contact',[PageController::class, 'contact'])->name('client.contact');

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
        Route::resource('feature', FeatureController::class);
        Route::resource('sosmed', SosmedController::class);
        Route::resource('testimonial', TestimonialController::class);

        Route::get('profile', [AdminProfileController::class, 'index'])->name('admin-profile.index');
        Route::get('member', [MemberController::class, 'index'])->name('admin-member.index');
        Route::get('member/{user}', [MemberController::class, 'show'])->name('admin-member.show');
        Route::put('member-banned/{user}', [MemberController::class, 'ban'])->name('admin-member.ban');
        Route::put('member-unbanned/{user}', [MemberController::class, 'unban'])->name('admin-member.unban');

        //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // PAGES ADMIN
        Route::prefix('pages')->group(function(){
            Route::get('how-to-order', [AdminPageController::class, 'howToOrder'])->name('admin.how-to-order');
            Route::patch('how-to-order/{page}', [AdminPageController::class, 'howToOrderUpdate'])->name('admin.how-to-order-update');

            Route::get('how-to-return', [AdminPageController::class, 'howToReturn'])->name('admin.how-to-return');
            Route::patch('how-to-return/{page}', [AdminPageController::class, 'howToReturnUpdate'])->name('admin.how-to-return-update');
            
            Route::get('payment-method', [AdminPageController::class, 'paymentMethod'])->name('admin.payment-method');
            Route::patch('payment-method/{page}', [AdminPageController::class, 'paymentMethodUpdate'])->name('admin.payment-method-update');
            
            Route::get('about-us', [AdminPageController::class, 'aboutUs'])->name('admin.about-us');
            Route::patch('about-us/{page}', [AdminPageController::class, 'aboutUsUpdate'])->name('admin.about-us-update');
            
            Route::get('contact', [AdminPageController::class, 'contact'])->name('admin.contact');
            Route::patch('contact/{page}', [AdminPageController::class, 'contactUpdate'])->name('admin.contact-update');
        });
    });

// untuk update profile photo admin & member
Route::post('/update-photo', [ProfileController::class, 'update_photo'])
    ->middleware(['auth', 'verified'])
    ->name('profile.update_photo');

require __DIR__ . '/auth.php';

Route::get('testing', function () {
    return view('testing');
});
