<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\HomepageClientController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\TestimonialController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// MEMBER ROUTES
Route::get('/', [ClientController::class, 'home'])->name('client.home');
Route::get('/promo', [ClientController::class, 'promo'])->name('client.promo');
Route::get('/lelang', [ClientController::class, 'lelang'])->name('client.lelang');

Route::post('/bid', [AuctionController::class, 'bid'])->name('bid.store');
Route::post('/comment', [AuctionController::class, 'comment'])->name('comment.store');

// PRODUCTS
Route::get('/products', [ProductController::class, 'allProducts'])->name('client.products');
Route::get('/product/{slug}', [ProductController::class, 'product'])->name('client.product');
Route::get('/products/category/{category}', [ProductController::class, 'productsByCategory'])->name('client.productsByCategory');

// CART

Route::get('/data-cart', [CartController::class, 'get_data']); // untuk diambil dari alpine
Route::post('/add-to-cart', [CartController::class, 'add_to_cart']); // untuk diambil dari alpine

Route::middleware(['auth', 'verified', 'can:is-member'])
    ->group(function () {
        Route::get('/cart', [CartController::class, 'index'])->name('client.cart');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('client.checkout');
        Route::patch('/update-qty/{cart}', [CartController::class, 'update_qty'])->name('client.update_qty');
        Route::delete('/remove-item/{cart}', [CartController::class, 'remove_item'])->name('client.remove_item');
    });

// BUAT AUTH DI VIEW AJAAAA


// PROFILE
Route::get('/profile', [ProfileController::class, 'index'])->name('client.profile')->middleware('auth', 'can:is-member');
Route::post('/profile/address', [ProfileController::class, 'store_address'])->name('profile.store_address');
Route::patch('/profile/address/{address}', [ProfileController::class, 'update_address'])->name('profile.update_address');
Route::delete('/profile/address/{address}', [ProfileController::class, 'destroy_address'])->name('profile.destroy_address');

// MEMBER PAGES
Route::get('/how-to-order', [PageController::class, 'howToOrder'])->name('client.how-to-order');
Route::get('/how-to-return', [PageController::class, 'howToReturn'])->name('client.how-to-return');
Route::get('/payment-method', [PageController::class, 'paymentMethod'])->name('client.payment-method');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('client.about-us');
Route::get('/contact', [PageController::class, 'contact'])->name('client.contact');

// END MEMBER ROUTES

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
        Route::resource('category', CategoryController::class)->except('show');
        Route::resource('product', ProductController::class);

        Route::get('profile', [ProfileController::class, 'indexAdmin'])->name('admin-profile.index');
        Route::get('member', [MemberController::class, 'index'])->name('admin-member.index');
        Route::get('member/{user}', [MemberController::class, 'show'])->name('admin-member.show');
        Route::put('member-banned/{user}', [MemberController::class, 'ban'])->name('admin-member.ban');
        Route::put('member-unbanned/{user}', [MemberController::class, 'unban'])->name('admin-member.unban');

        // PAGES ADMIN
        Route::prefix('pages')->group(function () {
            Route::get('how-to-order', [PageController::class, 'howToOrderAdmin'])->name('admin.how-to-order');
            Route::patch('how-to-order/{page}', [PageController::class, 'howToOrderUpdateAdmin'])->name('admin.how-to-order-update');

            Route::get('how-to-return', [PageController::class, 'howToReturnAdmin'])->name('admin.how-to-return');
            Route::patch('how-to-return/{page}', [PageController::class, 'howToReturnUpdateAdmin'])->name('admin.how-to-return-update');

            Route::get('payment-method', [PageController::class, 'paymentMethodAdmin'])->name('admin.payment-method');
            Route::patch('payment-method/{page}', [PageController::class, 'paymentMethodUpdateAdmin'])->name('admin.payment-method-update');

            Route::get('about-us', [PageController::class, 'aboutUsAdmin'])->name('admin.about-us');
            Route::patch('about-us/{page}', [PageController::class, 'aboutUsUpdateAdmin'])->name('admin.about-us-update');

            Route::get('contact', [PageController::class, 'contactAdmin'])->name('admin.contact');
            Route::patch('contact/{page}', [PageController::class, 'contactUpdateAdmin'])->name('admin.contact-update');
        });

        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::resource('auction', AuctionController::class)->only('store', 'update');
        Route::resource('homepage-client', HomepageClientController::class)->only('index', 'update');
    });


// untuk update profile photo admin & member DIKELUARKAN DARI ROUTE ADMIN KARENA HAK AKSES PADA ROUTE ADMIN TIDAK BISA DIAKSES MEMBER
Route::post('/update-photo', [ProfileController::class, 'update_photo'])
    ->middleware(['auth', 'verified'])
    ->name('profile.update_photo');

// FITUR TAMBAHAN
Route::get('/notification', [NotificationController::class, 'index'])->name('client.notification');
// END FITUR TAMBAHAN


require __DIR__ . '/auth.php';

Route::get('testing', function () {

    dd(User::paginate(1));
    return User::firstWhere('username', 'member1')->id;
    return view('testing');
});

Route::get('/dsc-webhook', function(){
    return response()->json(['status' => 'success'], 200, ['Content-Type' => 'application/x-www-urlencoded']);
});

Route::get('/get-areas-single', [CartController::class, 'get_areas_single'])->name('get-areas-single');