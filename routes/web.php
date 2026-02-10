<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;

use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/
Route::get('/shop', [ProductController::class, 'shop'])
    ->name('shop');

Route::get('/detail/{id}', [ProductController::class, 'show'])->name('detail');

Route::get('/wishlist', function () {
    return Inertia::render('Wishlist');
})->name('wishlist');

Route::get('/checkout', function () {
    return Inertia::render('Checkout');
})->name('checkout');
/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/
Route::get('/categories', [CategoryController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/
Route::get('/home', [ProductController::class, 'index'])->name('home');
Route::get('/products/{id}/related', [ProductController::class, 'relatedProducts']);

/*
|--------------------------------------------------------------------------
| Cart Routes (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add', [CartController::class, 'add'])
        ->name('cart.add');

    Route::post('/cart/update', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');
    Route::get('/cart/count', [CartController::class, 'count'])
        ->name('cart.count');
});

/*
|--------------------------------------------------------------------------
| Wisshlist Routes
|--------------------------------------------------------------------------
*/

Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])
    ->middleware('auth')
    ->name('wishlist.toggle');

/*
|--------------------------------------------------------------------------
| Authentication & OTP
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/otp-verify', [RegisteredUserController::class, 'verify_form'])
    ->name('verification.otp');

Route::post('/otp-verify', [RegisteredUserController::class, 'verify'])
    ->name('verification.verify_otp');

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\PasswordController;


Route::middleware('auth')->group(function () {

    Route::get('/account', function () {
        return Inertia::render('Profile/Account');
    })->name('account');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [PasswordController::class, 'update'])
        ->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
