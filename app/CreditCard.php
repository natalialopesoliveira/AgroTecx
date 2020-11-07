<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'credit_card';

    protected $fillable = [
        'titulo',
        'id_empresa',
        'descricao_longa'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
