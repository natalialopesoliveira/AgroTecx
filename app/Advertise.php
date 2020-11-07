<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $table = 'advertise';

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
