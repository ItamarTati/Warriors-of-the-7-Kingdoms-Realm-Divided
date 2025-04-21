<?php

namespace Database\Seeders;

use App\Models\Kingdom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class KingdomSeeder extends Seeder
{
    public function run(): void
    {
        $kingdoms = [
            [
                'name' => 'Eldoria',
                'ruler' => 'Queen Alaria',
                'capital' => 'Silverhold',
                'gold' => 12000,
                'influence' => 80,
                'food' => 4000,
                'population' => 90000,
                'tax_rate' => 12.5,
                'stability' => 85,
                'religion' => 'Light of Auriel',
                'government_type' => 'Monarchy',
                'banner_color' => 'gold',
                'banner_symbol' => 'phoenix',
                'founded_at' => Carbon::create(2000, 6, 1), // Updated to 1500
                'is_playable' => true,
                'ai_personality' => 'Diplomatic'
            ],
            [
                'name' => 'Thornhelm',
                'ruler' => 'King Drogmar',
                'capital' => 'Ironspire',
                'gold' => 9000,
                'influence' => 70,
                'food' => 3000,
                'population' => 75000,
                'tax_rate' => 15.0,
                'stability' => 70,
                'religion' => 'Forgefather Cult',
                'government_type' => 'Council of Lords',
                'banner_color' => 'black',
                'banner_symbol' => 'anvil',
                'founded_at' => Carbon::create(2000, 3, 12), // Updated to 1600
                'is_playable' => true,
                'ai_personality' => 'Aggressive'
            ],
            [
                'name' => 'Mystralis',
                'ruler' => 'Archmage Velion',
                'capital' => 'Crystalreach',
                'gold' => 15000,
                'influence' => 95,
                'food' => 2500,
                'population' => 60000,
                'tax_rate' => 10.0,
                'stability' => 90,
                'religion' => 'Arcane Concord',
                'government_type' => 'Magocracy',
                'banner_color' => 'purple',
                'banner_symbol' => 'arcane rune',
                'founded_at' => Carbon::create(2000, 1, 1), // Updated to 1700
                'is_playable' => false,
                'ai_personality' => 'Schemer'
            ],
        ];

        foreach ($kingdoms as $kingdom) {
            Kingdom::create($kingdom);
        }
    }
}