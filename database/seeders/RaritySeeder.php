<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rarity;

class RaritySeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['name' => 'Common',    'rank' => 1],
            ['name' => 'Uncommon',  'rank' => 2],
            ['name' => 'Rare',      'rank' => 3],
            ['name' => 'Legendary', 'rank' => 4],
        ];

        foreach ($rows as $r) {
            Rarity::updateOrCreate(['name' => $r['name']], $r);
        }
    }
}
