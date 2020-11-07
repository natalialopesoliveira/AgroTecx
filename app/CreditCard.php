<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'credit_card';

    protected $fillable = [
        'card_number',
        'card_name',
        'user_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
