<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Effect extends Model
{
    public const TYPE_BUFF = 'Buff';

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
        return $this->belongsToMany(Event::class, 'events_effects');
    }
}
