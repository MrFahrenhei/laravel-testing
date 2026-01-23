<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
// npm run dev -> vite
// php artisan serve -> run laravel server
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('jobs', JobController::class);
