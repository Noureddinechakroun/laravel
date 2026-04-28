<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::get('/signup', [SignupController::class, 'showSignup'])->name('signup');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');
Route::post('/verif_login', [LoginController::class, 'verifLogin'])->name('verif_login');

Route::get('/client', function () {
    return view('client');
})->name('client');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');