<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            EventSeeder::class,
            ItemSeeder::class
        ]);

        DB::table('enemies')->insert([
            'name' => 'Mighty warrior',
            'hp' => 30,
            'dexterity' => 3,
            'strength' => 3,
            'luck' => 3,
            'intelligence' => 3,
            'reward_gold' => 50,
            'reward_xp' => 50,
        ]);

        DB::table('effects')->insert([
            'type' => 'Buff',
            'hp_change' => 0,
            'dexterity_change' => 5,
            'strength_change' => 5,
            'luck_change' => 5,
            'intelligence_change' => 5,
        ]);
    }
}
