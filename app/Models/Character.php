<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
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
}
