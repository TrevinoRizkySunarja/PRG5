<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonCardController;
use App\Http\Controllers\RarityController;

/**
 * Zorg dat 'create' niet door 'show' wordt opgeslokt:
 * dit dwingt {card} naar een nummer, zodat 'create' niet matcht.
 */
Route::pattern('card', '[0-9]+');

/** HOME */
Route::get('/', [PokemonCardController::class, 'index'])->name('home');

/** AUTH-ONLY eerst (zodat 'create' vóór 'show' geregistreerd is) */
Route::middleware('auth')->group(function () {
    Route::resource('cards', PokemonCardController::class)->except(['index', 'show']);

    // (optioneel) rarities beheer
    Route::get('/rarities', [RarityController::class,'index'])->name('rarities.index');
    Route::post('/rarities', [RarityController::class,'store'])->name('rarities.store');
});

/** PUBLIC daarna: alleen index + show */
Route::resource('cards', PokemonCardController::class)->only(['index','show']);

/** Breeze */
require __DIR__.'/auth.php';
if (file_exists(__DIR__.'/profile.php')) require __DIR__.'/profile.php';
