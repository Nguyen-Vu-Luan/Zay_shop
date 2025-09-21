<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\orm\ShopController;
use App\Http\Controllers\orm\ProductController;
use App\Http\Controllers\user\UserProfileController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\WishlistController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminChatController;

// Public pages
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/shop-single', 'shop-single')->name('shop-single');

// Dashboard mặc định (admin sẽ override)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
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

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // MoMo
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/momo/callback', [OrderController::class, 'momoCallback'])->name('momo.callback');
    // routes/web.php
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/orders/{order}/pay-again', [OrderController::class, 'payAgain'])->name('orders.pay.again');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Users CRUD
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Products CRUD
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    // Orders CRUD (chỉ cho phép xem + cập nhật trạng thái, không tạo tay)
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{id}', [AdminController::class, 'viewOrder'])->name('admin.orders.view');
    Route::patch('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');
    Route::delete('/orders/{id}', [AdminController::class, 'deleteOrder'])->name('admin.orders.delete');
});

// User chat
Route::get('/chat', [ChatController::class, 'index'])->name('user.chat');
Route::get('/chat/popup', [ChatController::class, 'popup'])->name('user.chat.popup');
Route::post('/chat/send', [ChatController::class, 'send'])->name('user.chat.send');

// Admin chat
Route::get('/admin/chat', [AdminChatController::class, 'index'])->name('admin.chat');
Route::get('/admin/chat/{userId}', [AdminChatController::class, 'chat'])->name('admin.chat.user');
Route::post('/admin/chat/send/{userId}', [AdminChatController::class, 'send'])->name('admin.chat.send');
