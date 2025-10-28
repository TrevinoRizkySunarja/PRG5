<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonCardController;
use App\Http\Controllers\RarityController;

// Home -> kaarten-overzicht
Route::get('/', [PokemonCardController::class, 'index'])->name('home');

// Publiek: alleen index en show
Route::resource('cards', PokemonCardController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    // Achter login: create/store/edit/update/destroy
    Route::resource('cards', PokemonCardController::class)->except(['index', 'show']);

    // (Optioneel) Rarities-beheer achter login
    Route::get('/rarities', [RarityController::class, 'index'])->name('rarities.index');
    Route::post('/rarities', [RarityController::class, 'store'])->name('rarities.store');
});

// Breeze auth routes (login/register/etc.)
require __DIR__ . '/auth.php';
