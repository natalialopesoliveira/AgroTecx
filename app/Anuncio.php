<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $fillable = [
        'titulo',
        'descricao_longa',
        'preco'
    ];

    public function fotoAnuncio()
    {
        return $this->hasMany('App\FotoAnuncio');
    }

    public function fornecedor()
    {
        return $this->hasOne('App\Fornecedor');
    }

}
