<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $timestamps = false;
    protected $table = 'inventory';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
