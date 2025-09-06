<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\orm\ShopController;
use App\Http\Controllers\orm\ProductController;
use App\Http\Controllers\user\UserProfileController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\WishlistController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\GoogleController;

// Public pages
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/shop-single', 'shop-single')->name('shop-single');

// Dashboard mặc định (admin sẽ override)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile (user đã login)
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';


// SHOP public
Route::prefix('shop')->group(function () {
    Route::get('/', [ShopController::class, 'showShop'])->name('shop');
    Route::get('/search', [ProductController::class, 'search'])->name('product.search');
    Route::get('/product/{id}', [ProductController::class, 'showProduct'])
        ->whereNumber('id')
        ->name('product.show');
    Route::get('/category/{slug}', [ShopController::class, 'filterCategories'])->name('categories.filter');
    Route::get('/gender/{gender}', [ProductController::class, 'filterGender'])->name('gender.filter');
    Route::get('/brand/{brand}', [ProductController::class, 'filterBrand'])->name('brand.filter');
    Route::get('/category/{slug}/{gender}', [ProductController::class, 'filterCategoryGender'])
        ->name('category.gender.filter');
});

// Google login
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);


Route::middleware(['auth'])->group(function () {
    /// Profile
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [UserProfileController::class, 'updateProfile'])->name('user.updateProfile');
    Route::post('/profile/update-password', [UserProfileController::class, 'updatePassword'])->name('user.updatePassword');
    Route::post('/profile/update-avatar', [UserProfileController::class, 'updateAvatar'])->name('user.updateAvatar');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{product}/add', [WishlistController::class, 'store'])->name('wishlist.add');
    Route::delete('/wishlist/{product}/remove', [WishlistController::class, 'destroy'])->name('wishlist.remove');
    Route::delete('/wishlist/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');

    Route::get('/payment/momo', [PaymentController::class, 'momo'])->name('payment.momo');
    Route::get('/payment/vnpay', [PaymentController::class, 'vnpay'])->name('payment.vnpay');
});
