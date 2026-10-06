<?php

use Illuminate\Support\Facades\Route;

Route::view('/profile', 'profile')->name('profile');

Route::get('/', function () {
    return view('welcome');
});
