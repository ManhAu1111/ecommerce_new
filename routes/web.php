<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
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

Route::get('/home', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/shop', function () {
    return Inertia::render('Shop');
})->name('shop');

Route::get('/detail', function () {
    return Inertia::render('Detail');
})->name('detail');

Route::get('/cart', function () {
    return Inertia::render('Cart');
})->name('cart');

Route::get('/wishlist', function () {
    return Inertia::render('Wishlist');
})->name('wishlist');

Route::get('/checkout', function () {
    return Inertia::render('Checkout');
})->name('checkout');



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
