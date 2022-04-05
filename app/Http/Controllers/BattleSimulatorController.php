<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Enemy;
use App\Models\Inventory;
use App\Models\Item;
use App\Services\Wilderness\WildernessService;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class BattleSimulatorController extends Controller
{
    private WildernessService $wildernessService;

    public function __construct(WildernessService $wildernessService)
    {
        $this->wildernessService = $wildernessService;
    }

    public function getView()
    {
        $items = Item::pluck('name', 'id')->toArray();
        
        return View::make('battle-simulator', ['items' => $items, 'logs' => []]);
    }

    public function simulate(Request $request)
    {
        $params = $request->validate([
            'name' => 'required',
            'hp' => 'required',
            'dex' => 'required',
            'str' => 'required',
            'luck' => 'required',
            'int' => 'required',
            'charRing1' => '',
            'charRing2' => '',
            'charArmor' => '',
            'charWeapon' => '',
            'type' => 'required',
            'enemyhp' => 'required',
            'enemydex' => 'required',
            'enemystr' => 'required',
            'enemyluck' => 'required',
            'enemyint' => 'required',
        ]);

        $character = new Character([
            'name' => $params['name'],
            'hp' => $params['hp'],
            'max_hp' => $params['hp'],
            'dexterity' => $params['dex'],
            'strength' => $params['str'],
            'luck' => $params['luck'],
            'intelligence' => $params['int'],
            'dead' => 0
        ]);
        $enemy = new Enemy([
            'name' => $params['type'],
            'hp' => $params['enemyhp'],
            'max_hp' => $params['enemyhp'],
            'dexterity' => $params['enemydex'],
            'strength' => $params['enemystr'],
            'luck' => $params['enemyluck'],
            'intelligence' => $params['enemyint'],
            'reward_gold' => 0,
            'reward_xp' => 0
        ]);

        foreach (['charRing1', 'charRing2', 'charArmor', 'charWeapon'] as $itemSlot) {
            if (isset($params[$itemSlot])) {
                $inventory = new Inventory(['equipped' => 1]);
                $item = Item::find($params[$itemSlot]);
                $item->load('stats');
                $inventory->item = $item;
                $item->inventories->add($inventory);
                $character->inventories->add($inventory);
            }
        }
        $combatLogs = $this->wildernessService->processCombat([$enemy], $character);
        $items = Item::pluck('name', 'id')->toArray();
        return view('battle-simulator', ['items' => $items, 'logs' => $combatLogs]);
    }
}
