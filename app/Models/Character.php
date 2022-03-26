<?php

namespace App\Models;

use App\Constants\BaseStatValues;
use App\Constants\StatMultipliers;
use Illuminate\Database\Eloquent\Model;

class Character extends Model implements EntityInterface
{
    use EntityTrait;

    /**
     * Stat mods used for just 1 adventure
     */
    private $strengthMod = 0;
    private $dexterityMod = 0;
    private $intelligenceMod = 0;
    private $luckMod = 0;
    private $maxHpMod = 0;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'hp',
        'max_hp',
        'gold',
        'xp',
        'level',
        'dexterity',
        'strength',
        'luck',
        'intelligence',
        'dead',
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

    public function modifyMaxHpMod(int $change): void
    {
        $this->maxHpMod += $change;
        // Increase hp when the max hp is increased
        if ($change > 0) {
            $this->hp += $change;
        }
        // Decrease hp to the new max hp if the change is negative and the resulting max hp is lower than your current hp
        if ($change < 0 && $this->hp < ($this->max_hp + $this->maxHpMod)) {
            $this->hp = $this->max_hp + $this->maxHpMod;
        }
    }

    public function getType(): string
    {
        return 'character';
    }

    public function getLuckEventChanceModifier(): float
    {
        return ($this->luck + $this->lockMod) * StatMultipliers::LUCK_RARITY;
    }

    public function reduceHp(int $hp): void
    {
        $this->hp -= $hp;
        if ($this->hp < 0) {
            $this->hp = 0;
            $this->dead = true;
        }
    }

    public function isDead(): bool
    {
        return $this->dead;
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

    public function finishAdventure(): void
    {
        if ($this->hp > $this->max_hp) {
            $this->hp = $this->max_hp;
        }
    }
}
