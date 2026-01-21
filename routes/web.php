<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/account', function () {
//     return Inertia::render('profile/Account');
// })->name('account');
Route::get('/shop', function () {
    return Inertia::render('Shop');
})->name('shop');

Route::get('/cart', function () {
    return Inertia::render('Cart');
})->name('cart');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/account', function () {
        return Inertia::render('Profile/Account');
    })->name('account');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/otp-verify', [RegisteredUserController::class, 'verify_form'])
    ->name('verification.otp');

Route::post('/otp-verify', [RegisteredUserController::class, 'verify'])
    ->name('verification.verify_otp');

require __DIR__ . '/auth.php';
