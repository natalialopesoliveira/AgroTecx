<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

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
