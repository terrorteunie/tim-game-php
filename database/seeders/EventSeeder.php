<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gold = rand(1,99);

        DB::table('events')->insert([
            'name' => 'Treasure chest!',
            'description' => 'You found a treasure chest! It contains '.$gold.' gold!',
            'rarity' => 'Common',
            'reward_gold' => $gold,
            'reward_xp' => 2,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'Bear trap',
            'description' => 'Ouch! You\'ve stepped in a bear trap. You lost 10 health points.',
            'rarity' => 'Common',
            'reward_gold' => 0,
            'reward_xp' => 0,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'A challenger approaches!',
            'description' => 'A warrior challenges you to a duel (to the death)! Prepare yourself for battle.',
            'rarity' => 'Uncommon',
            'reward_gold' => 0,
            'reward_xp' => 50,
            'combat' => 1,
        ]);

        DB::table('events_enemies')->insert([            
            'event_id' => 3,
            'enemy_id' => 1,
        ]);

        DB::table('events')->insert([
            'name' => 'A suspicious looking rock',
            'description' => 'You come across a weird looking rock. Upon further examination you find nothing. Well.. maybe it was the wind.',
            'rarity' => 'Common',
            'reward_gold' => 0,
            'reward_xp' => 1,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'Is that a wizard?',
            'description' => 'You stumble across an old fellow with a pointy hat. You greet him and suddenly he casts a spell on you! You feel empowered. You gain +5 in every stat.',
            'rarity' => 'Legendary',
            'reward_gold' => 0,
            'reward_xp' => 20,
            'combat' => 0,
        ]);

        DB::table('events_effects')->insert([            
            'event_id' => 5,
            'effect_id' => 1,
        ]);
        

        DB::table('events')->insert([
            'name' => 'A suspicious looking rock',
            'description' => 'You come across a weird looking rock. Upon further examination you find 5 gold pieces. Meh, better than nothing atleast.',
            'rarity' => 'Uncommon',
            'reward_gold' => 5,
            'reward_xp' => 2,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'A suspicious looking rock',
            'description' => 'You come across a weird looking rock. Upon further examination you find 20 gold pieces!',
            'rarity' => 'Rare',
            'reward_gold' => 20,
            'reward_xp' => 3,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'A suspicious looking rock',
            'description' => 'You come across a weird looking rock. Upon further examination you find 100 gold pieces! Your lucky day!',
            'rarity' => 'Epic',
            'reward_gold' => 100,
            'reward_xp' => 3,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'A suspicious looking rock',
            'description' => 'You come across a weird looking rock. Upon further examination you find a sword stuck inside the rock. You try to pull it out and it works! Engraved in the sword is the text \'Excalibur\'.',
            'rarity' => 'Legendary',
            'reward_gold' => 0,
            'reward_xp' => 20,
            'combat' => 0,
        ]);
        
        DB::table('events_items')->insert([            
            'event_id' => 9,
            'item_id' => 1,
        ]);

        DB::table('events')->insert([
            'name' => 'Is that a scroll or are you just happy to see me?',
            'description' => 'A random traveler gives you a old scroll. Most of it is gibberish but some of it is useful information about combat. You gain some experience!',
            'rarity' => 'Common',
            'reward_gold' => 0,
            'reward_xp' => 10,
            'combat' => 0,
        ]);

        
    }
}