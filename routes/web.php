<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonCardController;

// HOME → cards overview
Route::get('/', [PokemonCardController::class, 'index'])->name('home');

// (optional) keep a dashboard alias if Breeze redirects there
Route::get('/dashboard', [PokemonCardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Public routes
Route::resource('cards', PokemonCardController::class)->only(['index', 'show']);

// Auth-only
Route::middleware('auth')->group(function () {
    Route::resource('cards', PokemonCardController::class)->except(['index', 'show']);
});

require __DIR__.'/auth.php';
require __DIR__.'/profile.php'; // only if you added it
