<?php

namespace App\Services\Wilderness;

use App\Models\Character;
use App\Models\Event;

class WildernessService
{
    public function createAdventure(int $distance, Character $character)
    {
        $events = Event::with('effects')->get();
        return $events;
    }
}
