<?php

namespace App\Services\Helpers;

class XpCalculator
{
    /**
     * Calculate the xp needed for the given level
     * @see https://oldschool.runescape.wiki/w/Experience for the inspiration of the calculation and full xp tables
     */
    public static function xpNeededForLevel(int $level): int
    {
        $previousLevel = $level - 1;
        $xp = (1 / 4) * floor($previousLevel + 300 * (pow(2, ($previousLevel / 7))));
        return $xp;
    }
}
