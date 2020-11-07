<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'empresa',
        'segmento',
        'senha',
        'estado'
    ];

    protected $hidden = [
        'senha'
    ];

    public function anuncios(){
        return $this->hasMany('App\Anuncio','id_empresa');
    }


}
