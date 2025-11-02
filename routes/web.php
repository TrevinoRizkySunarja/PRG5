<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonCardController;
use App\Http\Controllers\ProfileController;



Route::get('/', [PokemonCardController::class, 'index'])->name('home');
Route::get('/cards', [PokemonCardController::class, 'index'])->name('cards.index');


Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [PokemonCardController::class, 'index'])->name('dashboard');

    // Create & Store
    Route::get('/cards/create', [PokemonCardController::class, 'create'])->name('cards.create');
    Route::post('/cards', [PokemonCardController::class, 'store'])->name('cards.store');

    // Edit/Update/Delete
    Route::get('/cards/{card}/edit', [PokemonCardController::class, 'edit'])
        ->whereNumber('card')
        ->name('cards.edit');

    Route::put('/cards/{card}', [PokemonCardController::class, 'update'])
        ->whereNumber('card')
        ->name('cards.update');

    Route::delete('/cards/{card}', [PokemonCardController::class, 'destroy'])
        ->whereNumber('card')
        ->name('cards.destroy');

    // Extra actie
    Route::post('/cards/{card}/toggle-active', [PokemonCardController::class,'toggleActive'])
        ->whereNumber('card')
        ->name('cards.toggle');

    // Profiel
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/cards/{card}', [PokemonCardController::class, 'show'])
    ->whereNumber('card')
    ->name('cards.show');


require __DIR__.'/auth.php';
