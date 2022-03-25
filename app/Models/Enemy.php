<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enemy extends Model
{
    public $timestamps = false;
    protected $table = 'enemies';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_enemies');
    }
}
