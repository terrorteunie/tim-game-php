<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Wilderness\WildernessService;
use Illuminate\Support\Facades\Auth;

class WildernessController extends Controller
{
    private WildernessService $wildernessService;

    public function __construct(WildernessService $wildernessService)
    {
        $this->wildernessService = $wildernessService;
    }

    public function createAdventure(Character $character, Request $request)
    {
        // First check if character belongs to user
        $user = Auth::user();
        if ($character->user->id !== $user->id) {
            return ['error' => 'this character does not belong to you'];
        }
        $params = $request->validate([
            'distance' => 'required|int',
        ]);

        

        return $this->wildernessService->createAdventure($params['distance'], $character);
    }
}
