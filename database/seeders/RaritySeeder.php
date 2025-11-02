<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rarity;

class RaritySeeder extends Seeder
{
    public function run(): void
    {
        Rarity::upsert([
            ['id' => 1, 'name' => 'Common',    'rank' => 1],
            ['id' => 2, 'name' => 'Uncommon',  'rank' => 2],
            ['id' => 3, 'name' => 'Rare',      'rank' => 3],
            ['id' => 4, 'name' => 'Legendary', 'rank' => 4],
        ], ['id'], ['name','rank']);
    }
}
