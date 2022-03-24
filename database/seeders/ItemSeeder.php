<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'name' => 'Excalibur',
            'type' => 'weapon',
            'gold_value' => 1000,
        ]);

        DB::table('stats')->insert([
            'type' => 'damage',
            'min' => 10,
            'max' => 20,
        ]);

        DB::table('items_stats')->insert([            
            'stat_id' => 1,
            'item_id' => 1,
        ]);
    }
}
