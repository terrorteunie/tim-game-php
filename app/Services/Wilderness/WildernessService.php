<?php

namespace App\Services\Wilderness;

use App\Models\Character;
use App\Models\Event;
use App\Models\Effect;
use App\Services\Helpers\RNGsus;

class WildernessService
{
    private const LEGENDARY_CHANCE = 1;
    private const EPIC_CHANCE = 5;
    private const RARE_CHANCE = 14;
    private const UNCOMMON_CHANCE = 30;

    public function createAdventure(int $distance, Character $character)
    {
        $eventLogs = [];
        foreach (range(0, $distance) as $eventNumber) {
            $event = $this->getEvent($character);
            $this->processEvent($event, $character);
            $eventLogs[] = [
                'rarity' => $event->rarity,
                'description' => $event->description
            ];
        }
        return $eventLogs;
    }

    private function getEvent(Character $character): Event
    {
        $rarity = $this->getRarity($character);
        $possibleEvents = Event::where('rarity', $rarity)->get()->all();
        return RNGsus::gamble($possibleEvents);
    }

    private function processEvent(Event $event, Character $character): void
    {
        $character->modifyGold($event->reward_gold);
        $character->modifyXp($event->reward_xp);
        
        foreach ($event->effects as $effect) {
            $this->processEffect($effect, $character);
        }

        $character->save();
    }

    private function processEffect(Effect $effect, Character $character): void
    {
        switch ($effect->type) {
            case Effect::TYPE_BUFF:
                $character->modifyStrengthMod($effect->strength_change);
                $character->modifyDexterityMod($effect->dexterity_change);
                $character->modifyIntelligenceMod($effect->intelligence_change);
                $character->modifyLuckMod($effect->luck_change);
                // TODO hp change
            default:
                // do nothing
        }
    }

    private function getRarity(Character $character): string
    {
        $luckModifier = $character->getLuckEventChanceModifier();
        $legendaryChance = self::LEGENDARY_CHANCE + $luckModifier;
        if (RNGsus::pray($legendaryChance)) {
            return Event::LEGENDARY;
        }
        $epicChance = self::EPIC_CHANCE + $luckModifier;
        if (RNGsus::pray($epicChance)) {
            return Event::EPIC;
        }
        $rareChance = self::RARE_CHANCE + $luckModifier;
        if (RNGsus::pray($rareChance)) {
            return Event::RARE;
        }
        $uncommon = self::UNCOMMON_CHANCE + $luckModifier;
        if (RNGsus::pray($uncommon)) {
            return Event::UNCOMMON;
        }
        return Event::COMMON;
    }
}
