<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rarity extends Model {
    use HasFactory;
    protected $fillable = ['name','rank'];

    public function cards() {
        return $this->hasMany(PokemonCard::class);
    }
}
