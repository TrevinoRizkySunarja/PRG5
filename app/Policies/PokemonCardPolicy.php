<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PokemonCard;

class PokemonCardPolicy
{
    public function view(?User $user, PokemonCard $card): bool
    {
        // anyone can view
        return true;
    }

    public function create(User $user): bool
    {
        return true; // any authenticated user may create
    }

    public function update(User $user, PokemonCard $card): bool
    {
        return $card->user_id === $user->id; // only owner may update
    }

    public function delete(User $user, PokemonCard $card): bool
    {
        return $card->user_id === $user->id; // only owner may delete
    }

    // custom ability used by your toggle action
    public function toggle(User $user, PokemonCard $card): bool
    {
        return $card->user_id === $user->id;
    }
}
