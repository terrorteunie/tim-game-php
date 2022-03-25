<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'reward_gold',
        'reward_xp',
        'rarity',
        'combat'
    ];

    public function effects()
    {
        return $this->belongsToMany(Effect::class, 'events_effects');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'events_items');
    }

    public function enemies()
    {
        return $this->belongsToMany(Enemy::class, 'events_enemies');
    }
    

}
