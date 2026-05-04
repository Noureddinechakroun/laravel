<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\LocationController;
use App\Models\Voiture;

// ── Routes publiques ──────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',    [LoginController::class,  'showLogin'])->name('login');
Route::get('/signup',   [SignupController::class, 'showSignup'])->name('signup');
Route::post('/signup',  [SignupController::class, 'store'])->name('signup.store');
Route::post('/verif_login', [LoginController::class, 'verifLogin'])->name('verif_login');

// ── Logout ────────────────────────────────────────────────
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// ── Admin ─────────────────────────────────────────────────
Route::redirect('/admin', '/admin/dashboard');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin');
    Route::resource('users',     UserController::class)->except(['show']);
    Route::resource('voitures',  VoitureController::class)->except(['show']);
    Route::resource('locations', LocationController::class)->except(['show']);
});

// ── Client (protégé par auth) ─────────────────────────────
Route::middleware('auth')->group(function () {

    Route::get('/client', function () {
        $voitures = Voiture::where('statut', 'disponible')->latest()->get();
        return view('client', compact('voitures'));
    })->name('client');

    Route::get('/mes-locations', [LocationController::class, 'clientIndex'])
        ->name('locations.client');

    Route::get('/facture/{id}', [LocationController::class, 'facture'])
        ->name('locations.facture');

    Route::get('/ma-facture', [LocationController::class, 'derniereFacture'])
        ->name('facture.derniere');

    Route::get('/louer/{voiture}', [LocationController::class, 'create'])
        ->name('client.locations.create');

    Route::post('/louer/{voiture}', [LocationController::class, 'store'])
        ->name('client.locations.store');
});
