<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::view('/profile', 'profile')->name('profile');

Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
