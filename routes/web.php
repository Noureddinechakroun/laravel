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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',    [LoginController::class,  'showLogin'])->name('login');
Route::get('/signup',   [SignupController::class, 'showSignup'])->name('signup');
Route::post('/signup',  [SignupController::class, 'store'])->name('signup.store');
Route::post('/verif_login', [LoginController::class, 'verifLogin'])->name('verif_login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::redirect('/admin', '/admin/dashboard');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/voitures', [VoitureController::class, 'index'])->name('voitures.index');
    Route::get('/voitures/create', [VoitureController::class, 'create'])->name('voitures.create');
    Route::post('/voitures', [VoitureController::class, 'store'])->name('voitures.store');
    Route::get('/voitures/{voiture}/edit', [VoitureController::class, 'edit'])->name('voitures.edit');
    Route::put('/voitures/{voiture}', [VoitureController::class, 'update'])->name('voitures.update');
    Route::delete('/voitures/{voiture}', [VoitureController::class, 'destroy'])->name('voitures.destroy');

    Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
    Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
    Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
    Route::get('/locations/{location}/edit', [LocationController::class, 'edit'])->name('locations.edit');
    Route::put('/locations/{location}', [LocationController::class, 'update'])->name('locations.update');
    Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');
});

Route::middleware('auth')->group(function () {

    Route::get('/client', function () {
        $voitures = Voiture::where('statut', 'disponible')->latest()->get();
        return view('client', compact('voitures'));
    })->name('client');

    Route::get('/mes-locations', [LocationController::class, 'clientIndex'])
        ->name('locations.client');

    Route::get('/mes-locations/{location}/modifier', [LocationController::class, 'clientEdit'])
        ->name('client.locations.edit');

    Route::put('/mes-locations/{location}', [LocationController::class, 'clientUpdate'])
        ->name('client.locations.update');

    Route::put('/mes-locations/{location}/annuler', [LocationController::class, 'clientCancel'])
        ->name('client.locations.cancel');

    Route::get('/facture/{id}', [LocationController::class, 'facture'])
        ->name('locations.facture');

    Route::get('/ma-facture', [LocationController::class, 'derniereFacture'])
        ->name('facture.derniere');

    Route::get('/louer/{voiture}', [LocationController::class, 'create'])
        ->name('client.locations.create');

    Route::post('/louer/{voiture}', [LocationController::class, 'store'])
        ->name('client.locations.store');

    Route::get('/mes-informations', [UserController::class, 'profileEdit'])
        ->name('client.profile.edit');

    Route::put('/mes-informations', [UserController::class, 'profileUpdate'])
        ->name('client.profile.update');
});
