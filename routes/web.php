<?php

// use App\Http\Controllers\authController;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// // Route default saat akses http://localhost/
// Route::get('/', [AuthController::class, 'showSignin'])->name('signin.default');

// // route Sign Up
// route::get('/signup', [authController::class, 'showSignup'])-> name('signup.show');
// route::post('/signup/submit', [authController::class, 'submitSignup'])-> name('signup.submit');

// // route Sign In
// route::get('/signin', [authController::class, 'showSignin'])-> name('signin.show');
// route::post('/signin/submit', [authController::class, 'submitSignin'])-> name('signin.submit');
// route::get('/welcome', [authController::class, 'showWelcome'])-> name('welcome.show');

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin', function () {
//         return view('admin.dashboard');
//     });
// });

// Route untuk multiple roles (admin dan manager)
// Route::middleware(['auth', 'role:admin,manager'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     });
// });
// routes/web.php


// Auth Routes

    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup.show');
    Route::post('/signup', [AuthController::class, 'submitSignup'])->name('signup.submit');
    Route::get('/signin', [AuthController::class, 'showSignin'])->name('signin.show');
    Route::post('/signin', [AuthController::class, 'submitSignin'])->name('signin.submit');


// Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('/signout', [AuthController::class, 'signOut'])->name('signout');
    
    // Admin Routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [AuthController::class, 'showAdmin'])->name('admin.show');
    });
    
    
    // User Routes
    Route::middleware('role:user')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'showUser'])->name('user.show');
    });
});