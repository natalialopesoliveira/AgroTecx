<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmark';

    protected $fillable = [
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
