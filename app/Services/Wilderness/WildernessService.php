<?php

namespace App\Services\Wilderness;

use App\Constants\StatMultipliers;
use App\Models\Character;
use App\Models\Event;
use App\Models\Effect;
use App\Models\EntityInterface;
use App\Models\Stat;
use App\Services\Helpers\RNGsus;
use Exception;

class WildernessService
{
    private const LEGENDARY_CHANCE = 1;
    private const EPIC_CHANCE = 5;
    private const RARE_CHANCE = 14;
    private const UNCOMMON_CHANCE = 30;

    public function createAdventure(int $distance, Character $character): array
    {
        $eventLogs = [];
        foreach (range(1, $distance) as $eventNumber) {
            $event = $this->getEvent($character);
            $combatLog = $this->processEvent($event, $character);
            $description = $event->description;
            if ($combatLog !== '') {
                $description .= "\n" . $combatLog;
            }
            $eventLogs[] = [
                'rarity' => $event->rarity,
                'description' => $description
            ];
            if ($character->isDead()) {
                break;
            }
        }
        $character->finishAdventure();
        $character->save();
        return $eventLogs;
    }

    private function getEvent(Character $character): Event
    {
        $rarity = $this->getRarity($character);
        $possibleEvents = Event::where('rarity', $rarity)->get()->all();
        return RNGsus::gamble($possibleEvents);
    }

    private function processEvent(Event $event, Character $character): string
    {
        // Do the effects first
        foreach ($event->effects as $effect) {
            $this->processEffect($effect, $character);
        }

        // Then the combat
        $combatLog = '';
        if ($event->combat) {
            $combatLogs = $this->processCombat($event->enemies, $character);
            $combatLog = implode("\n", $combatLogs);
        }


        // Lastly do the event stats itself
        $character->modifyGold($event->reward_gold);
        $character->modifyXp($event->reward_xp);

        $character->save();

        return $combatLog;
    }

    private function processEffect(Effect $effect, Character $character): void
    {
        switch ($effect->type) {
            case Effect::TYPE_BUFF:
                $character->modifyStrengthMod($effect->strength_change);
                $character->modifyDexterityMod($effect->dexterity_change);
                $character->modifyIntelligenceMod($effect->intelligence_change);
                $character->modifyLuckMod($effect->luck_change);
                $character->modifyMaxHpMod($effect->hp_change);
            default:
                // do nothing
        }
    }

    public function processCombat($enemies, Character $character): array
    {
        // Sort enemies and the character in a list by their initiative
        $characterAndEnemies = [...$enemies, $character];
        usort($characterAndEnemies, function ($entityA, $entityB) {
            return $entityA->getInitiative() <=> $entityB->getInitiative();
        });

        foreach ($character->inventories as $inventory) {
            $item = $inventory->item;
            $stats = $item->stats;
            foreach ($stats as $stat) {
                $this->processStat($stat, $character);
            }
        }

        $combatLogs = [];
        $combatIsfinished = false;
        while (!$combatIsfinished) {
            foreach ($characterAndEnemies as $entity) {
                // The character's turn
                if ($entity->getType() === 'character') {
                    $enemiesDead = true;
                    foreach ($enemies as $enemy) {
                        // Attack first enemy that is alive
                        if (!$enemy->isDead()) {
                            $combatLogs[] = $this->hit($entity, $enemy);
                            // If the hit killed the enemey, reward its rewards
                            if ($enemy->isDead()) {
                                $character->modifyGold($enemy->reward_gold);
                                $character->modifyXp($enemy->reward_xp);
                            } else {
                                // Else make sure that we know there are still enemies alive
                                $enemiesDead = false;
                            }
                        }
                    }
                    // All enemies are dead, stop the combat
                    if ($enemiesDead) {
                        $combatIsfinished = true;
                        break;
                    }
                }
                // Enemy's turn
                if ($entity->getType() === 'enemy') {
                    $combatLogs[] = $this->hit($entity, $character);
                    // Character is dead, stop the combat
                    if ($character->isDead()) {
                        $combatIsfinished = true;
                        break;
                    }
                }
            }
        }
        return $combatLogs;
    }

    private function processStat(Stat $stat, Character $character): void
    {
        switch ($stat->type) {
            case Stat::DAMAGE:
                $character->modifyItemDamageMin($stat->min);
                $character->modifyItemDamageMax($stat->max);
                break;
            case Stat::HP:
                $character->modifyMaxHpMod($stat->min);
                break;
            case Stat::ARMOR:
                $character->modifyArmor($stat->min);
                break;
            case Stat::STRENGTH:
                $character->modifyStrengthMod($stat->min);
                break;
            case Stat::DEXTERITY:
                $character->modifyDexterityMod($stat->min);
                break;
            case Stat::INTELLIGENCE:
                $character->modifyIntelligenceMod($stat->min);
                break;
            case Stat::LUCK:
                $character->modifyLuckMod($stat->min);
                break;
            default:
                throw new Exception('Stat with type ' . $stat->type . ' not recognized.');
        }
    }

    /**
     * $entityA will attempt to hit $entityB
     */
    private function hit(EntityInterface $entityA, EntityInterface $entityB): string
    {
        // Check if there is a hit
        $hit = RNGsus::pray($entityA->getHitChance());
        if (!$hit) {
            return $entityA->name . " misses the attack.";
        }
        // If there is a hit, then check if the other person dodges
        $dodge = RNGsus::pray($entityB->getDodgeChance());
        if ($dodge) {
            return $entityA->name . " hits, but " . $entityB->name . " dodges the attack.";
        }
        // There is a hit and no dodge, calculate damage
        // Base damage from strength
        $damage = $entityA->getBaseDamage();
        // Damage from items, only for characters
        if ($entityA instanceof Character) {
            $damage += RNGsus::tempt($entityA->getItemDamageMin(), $entityA->getItemDamageMax());
        }
        // Damage from crit
        $critRoll = RNGsus::pray($entityA->getCritChance());
        if ($critRoll) {
            $damage *= StatMultipliers::CRIT_DAMAGE;
        }
        // If the damage receiving entity is the character, decude damage by armour
        if ($entityB instanceof Character) {
            $damage -= $entityB->getArmor() * StatMultipliers::ARMOR_EFFECTIVE;
            if ($damage < 0) {
                $damage = 0;
            }
        }

        // Deal the damage
        $entityB->reduceHp($damage);

        $log = $entityA->name . " hits " . $entityB->name . " for $damage damage.";

        if ($entityB->isDead()) {
            $log .= "\n" . $entityB->name . " is dead.";
        }
        return $log;
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
