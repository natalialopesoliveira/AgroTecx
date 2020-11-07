<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $fillable = [
        'titulo',
        'descricao_longa'
    ];

    public function conta()
    {
        return $this->belongsTo('App\Conta');
    }


}
