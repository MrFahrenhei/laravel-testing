<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
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
Route::resource('jobs', JobController::class);

Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
