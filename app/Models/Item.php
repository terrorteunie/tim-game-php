<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_items');
    }
    
    public function stats()
    {
        return $this->belongsToMany(Stat::class, 'items_stats');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
