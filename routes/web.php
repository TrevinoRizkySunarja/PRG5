<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonCardController;
use App\Http\Controllers\RarityController;

// Home -> overview
Route::get('/', [PokemonCardController::class, 'index'])->name('home');

// Public: index + show
Route::resource('cards', PokemonCardController::class)->only(['index', 'show']);

// Auth required: create/store/edit/update/destroy
Route::middleware('auth')->group(function () {
    Route::resource('cards', PokemonCardController::class)->except(['index', 'show']);

    // optional rarity admin pages
    Route::get('/rarities', [RarityController::class, 'index'])->name('rarities.index');
    Route::post('/rarities', [RarityController::class, 'store'])->name('rarities.store');
});



// Breeze routes
require __DIR__.'/auth.php';
require __DIR__.'/profile.php'; // if you added profile routes
