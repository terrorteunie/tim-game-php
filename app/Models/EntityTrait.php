<?php

namespace App\Models;

use App\Constants\BaseStatValues;
use App\Constants\StatMultipliers;

trait EntityTrait
{
    public function getInitiative(): int
    {
        return (($this->dexterityMod + $this->dexterity) * StatMultipliers::DEXTERITY_INITIATIVE) + BaseStatValues::INITIATIVE;
    }

    public function getHitChance(): int
    {
        $intelligence = $this->intelligence + $this->intelligenceMod;
        return $intelligence * StatMultipliers::INTELLIGENCE_HIT_CHANCE + BaseStatValues::HIT_CHANCE;
    }

    public function getDodgeChance(): int
    {
        $dexterity = $this->dexterity + $this->dexterityMod;
        return $dexterity * StatMultipliers::DEXTERITY_DODGE + BaseStatValues::DODGE_CHANCE;
    }

    public function getBaseDamage(): int
    {
        $strength = $this->strength + $this->strengthMod;
        return $strength * StatMultipliers::STRENGTH_DAMAGE + BaseStatValues::DAMAGE;
    }

    public function getCritChance(): int
    {
        $luck = $this->luck + $this->luckMod;
        return $luck * StatMultipliers::LUCK_CRIT_CHANCE + BaseStatValues::CRIT_CHANCE;
    }
}
