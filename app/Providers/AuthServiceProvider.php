<?php

namespace App\Providers;

use App\Models\PokemonCard;
use App\Policies\PokemonCardPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        PokemonCard::class => PokemonCardPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
