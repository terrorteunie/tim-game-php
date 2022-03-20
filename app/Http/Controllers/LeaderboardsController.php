<?php

namespace App\Http\Controllers;

use App\Models\Character;

class LeaderboardsController extends Controller
{
    public function get()
    {
        $characters = Character::orderBy('level', 'desc')->orderBy('xp', 'desc')->limit(10)->get();
        $leaderboards = [];
        foreach ($characters as $character) {
            $leaderboards[] = [
                'name' => $character->name,
                'level' => $character->level,
                'xp' => $character->xp
            ];
        }
        return $leaderboards;
    }
}
