<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    public const DAMAGE = 'damage';
    public const HP = 'hp';
    public const STRENGTH = 'strength';
    public const INTELLIGENCE = 'intelligence';
    public const DEXTERITY = 'dexterity';
    public const LUCK = 'luck';
    public const ARMOR = 'armor';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'items_stats');
    }
}
