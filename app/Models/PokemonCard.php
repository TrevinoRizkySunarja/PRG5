<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PokemonCard extends Model {
    use HasFactory;

    protected $fillable = ['name','image_url','rarity_id','description','user_id'];

    public function rarity() { return $this->belongsTo(Rarity::class); }
    public function user()   { return $this->belongsTo(User::class); }
}
