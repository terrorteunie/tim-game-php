<?php

namespace App\Services\Helpers;

class RNGsus
{
    private const MAX_ROLL = 10000;

    /**
     * Use this when you want to check if a certain chance is a success
     */
    public static function pray(float $succesChance)
    {
        // needs to be converted to int for the random function
        // allow for 2 decimals after the comma for percentages
        $rollToBeat = (int) ($succesChance * 100);
        $roll = rand(0, self::MAX_ROLL);
        return $roll < $rollToBeat; 
    }

    /**
     * Use this when you want to gamble with a with 'possibilities'
     * Pass objects in an array and the 'winning' possibility will be returned
     */
    public static function gamble(array $possibilities)
    {
        $maxRoll = count($possibilities) - 1;
        $roll = rand(0, $maxRoll);
        return $possibilities[$roll];
    }
}
