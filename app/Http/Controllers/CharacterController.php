<?php

namespace App\Http\Controllers;

use App\Constants\BaseStatValues;
use App\Constants\StatMultipliers;
use App\Models\Character;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function create(Request $request)
    {
        $params = $request->validate([
            'name' => 'required',
            'strength' => 'required|int',
            'dexterity' => 'required|int',
            'intelligence' => 'required|int',
            'luck' => 'required|int',
        ]);
        $user = Auth::user();
        $hp = BaseStatValues::HP + $params['strength'] * StatMultipliers::STRENGTH_HP;
        $character = new Character(
            [
                'strength' => $params['strength'],
                'dexterity' => $params['dexterity'],
                'intelligence' => $params['intelligence'],
                'luck' => $params['luck'],
                'name' => $params['name'],
                'hp' => $hp,
                'max_hp' => $hp,
                'dead' => false,
                'gold' => 0,
                'xp' => 0,
                'level' => 1,
            ]
        );
        $user->characters()->save($character);
        return $character;
    }

    public function get(Character $character)
    {
        // First check if character belongs to user
        $user = Auth::user();
        if ($character->user->id !== $user->id) {
            return ['error' => 'this character does not belong to you'];
        }
        return $character;
    }

    public function getAll()
    {
        $user = Auth::user();
        return $user->characters;
    }

    public function delete(Character $character)
    {
        // First check if character belongs to user
        $user = Auth::user();
        if ($character->user->id !== $user->id) {
            return ['error' => 'this character does not belong to you'];
        }
        $character->delete();
        return ['succes' => true];
    }

    public function saveStats(Character $character, Request $request)
    {
        // First check if character belongs to user
        $user = Auth::user();
        if ($character->user->id !== $user->id) {
            return ['error' => 'this character does not belong to you'];
        }
        $params = $request->validate([
            'strength' => 'int|required',
            'dexterity' => 'int|required',
            'intelligence' => 'int|required',
            'luck' => 'int|required',
        ]);

        if ($params['strength'] < $character->strength) {
            return ['error' => 'you cannot decrease your attributes'];
        }
        if ($params['dexterity'] < $character->dexterity) {
            return ['error' => 'you cannot decrease your attributes'];
        }
        if ($params['intelligence'] < $character->intelligence) {
            return ['error' => 'you cannot decrease your attributes'];
        }
        if ($params['luck'] < $character->luck) {
            return ['error' => 'you cannot decrease your attributes'];
        }
        $character->strength = $params['strength'];
        $character->dexterity = $params['dexterity'];
        $character->intelligence = $params['intelligence'];
        $character->luck = $params['luck'];
        $character->save();
        return $character;
    }
}
