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
        
        DB::table('events')->insert([
            'name' => 'Thanks dad...',
            'description' => 'A random traveler gives you some unwarranted advice. You don\'t want or need it but whatever. You gain 1 experience point for listening.',
            'rarity' => 'Common',
            'reward_gold' => 0,
            'reward_xp' => 1,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'A sip o\' water',
            'description' => 'You hear a nearby river flowing. You go towards it and take a sip of water from the stream. You feel refreshed and gain 2 health points.',
            'rarity' => 'Common',
            'reward_gold' => 0,
            'reward_xp' => 0,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'Knowledge is power',
            'description' => 'You take a small break and read something from your book. Tales of Herman the Knight. You gain some XP from the knowledge gained.',
            'rarity' => 'Common',
            'reward_gold' => 0,
            'reward_xp' => 3,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'Poor old beggar',
            'description' => 'An old beggar approaches you and asks for a few gold pieces. You have no spine, so you give the fellow 10 gold.',
            'rarity' => 'Common',
            'reward_gold' => -10,
            'reward_xp' => 0,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'One man\'s garbage is another man\'s treasure',
            'description' => 'You come across some wandering merchants. You greet each other in a friendly manner and you are able to sell some useless junk you found along the road. You gain 50 gold!',
            'rarity' => 'Uncommon',
            'reward_gold' => 50,
            'reward_xp' => 0,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'One man\'s garbage is still another man\'s garbage',
            'description' => 'You come across some wandering merchants. You greet each other in a friendly manner but the found your stuff useless. You gain nothing.',
            'rarity' => 'Uncommon',
            'reward_gold' => 0,
            'reward_xp' => 0,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'Did I hear something?',
            'description' => 'While walking the road some figure quickly approaches you and snatches some gold from your satchel and runs off. You lose 20 gold!',
            'rarity' => 'rare',
            'reward_gold' => -20,
            'reward_xp' => 0,
            'combat' => 0,
        ]);

        DB::table('events')->insert([
            'name' => 'Is that the one and only Lance Harold the Fifth?',
            'description' => 'You stumbled across the famous knight Harold the Fifth. You speak briefly with him and gain 100 experience!',
            'rarity' => 'rare',
            'reward_gold' => 0,
            'reward_xp' => 100,
            'combat' => 0,
        ]);
    }
}