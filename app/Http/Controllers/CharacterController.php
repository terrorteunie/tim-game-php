<?php

namespace App\Http\Controllers;

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
        $hp = 50 + $params['strength'] * 5;
        $character = new Character(
            [
                ...$params,
                'hp' => $hp,
                'gold' => 0,
                'xp' => 0,
                'level' => 0,
            ]
        );
        $user->characters()->save($character);
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
}
