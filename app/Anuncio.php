<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $fillable = [
        'titulo',
        'id_empresa'
        'descricao_longa'
    ];

    public function conta()
    {
        return $this->belongsTo('App\Conta');
    }


}
