<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /**
     * Stat mods used for just 1 adventure
     */
    private $strengthMod = 0;
    private $dexterityMod = 0;
    private $intelligenceMod = 0;
    private $luckMod = 0;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'hp',
        'gold',
        'xp',
        'level',
        'dexterity',
        'strength',
        'luck',
        'intelligence',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modifyStrengthMod(int $change): void
    {
        $this->strengthMod += $change;
    }

    public function modifyDexterityMod(int $change): void
    {
        $this->dexterityMod += $change;
    }

    public function modifyIntelligenceMod(int $change): void
    {
        $this->intelligenceMod += $change;
    }

    public function modifyLuckMod(int $change): void
    {
        $this->luckMod += $change;
    }

    public function getLuckEventChanceModifier(): float
    {
        return ($this->luck + $this->lockMod) * 0.1;
    }

    public function modifyGold(int $gold): void
    {
        $this->gold += $gold;
        if ($this->gold < 0) {
            $this->gold = 0;
        }
    }

    public function modifyXp(int $xp): void
    {
        if ($xp < 0) {
            $xp = 0;
        }
        $this->xp += $xp;
        // TODO level up check code
    }
}
