<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

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
