<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public const LEGENDARY = 'Legendary';
    public const EPIC = 'Epic';
    public const RARE = 'Rare';
    public const UNCOMMON = 'Uncommon';
    public const COMMON = 'Common';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
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
