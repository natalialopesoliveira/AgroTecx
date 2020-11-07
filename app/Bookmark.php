<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmark';

    protected $fillable = [
        'advertise'
    ];

    public function advertise()
    {
        return $this->hasMany(Advertise::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
