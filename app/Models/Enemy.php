<?php

namespace App\Models;

use App\Constants\BaseStatValues;
use App\Constants\StatMultipliers;
use Illuminate\Database\Eloquent\Model;

class Enemy extends Model implements EntityInterface
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
    protected $table = 'enemies';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'hp',
        'max_hp',
        'level',
        'dexterity',
        'strength',
        'luck',
        'intelligence',
        'reward_gold',
        'reward_xp'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_enemies');
    }

    public function getType(): string
    {
        return 'enemy';
    }

    public function reduceHp(int $hp): void
    {
        $this->hp -= $hp;
    }

    public function isDead(): bool
    {
        return $this->hp < 0;
    }
}
