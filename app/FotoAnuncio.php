<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotoAnuncio extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'fornecedor'
        'imagem'
    ];

    public function anuncio()
    {
        return $this->hasOne('App\Anuncio');
    }
}
