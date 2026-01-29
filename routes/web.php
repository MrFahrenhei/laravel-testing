<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

// npm run dev -> vite
// php artisan serve -> run laravel server
/*
Laravel authentications
Laravel Breeze - Easy to use starter kit
Laravel Jetstream - Feature-rich starter kit
Laravel Fortify - Frontend agnostic authentication
Laravel Sanctum - API authentication
Socialite - Use OAuth with providers (Facebook, Google, etc.)
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::resource('jobs', JobController::class);
Route::resource('jobs', JobController::class)->middleware('auth')->only(['create', 'edit', 'update', 'destroy' ]);
Route::resource('jobs', JobController::class)->except(['create', 'edit', 'update', 'destroy' ]);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});
//Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{job}', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/bookmarks/{job}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});

Route::post('/jobs/{job}/apply', [ApplicantController::class, 'store'])->name('applicant.store')->middleware('auth');
Route::delete('/applicants/{applicant}', [ApplicantController::class, 'destroy'])->name('applicant.destroy')->middleware('auth');
