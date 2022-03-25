<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function createEvent(Request $request){
        $params = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'rarity' => 'required',
            'gold' => 'required',
            'xp' => 'required',
        ]);

        $event = new Event(
            [                
                'name' => $params['name'],
                'description' => $params['description'],
                'rarity' => $params['rarity'],
                'reward_gold' => $params['gold'],
                'reward_xp' => $params['xp'],
                'combat' => '0',
            ]
        );
        //die(dd($event));
        $event->save();
        return view('event-creator');
    }
}
