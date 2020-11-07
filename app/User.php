<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'user';

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

    public function advertise()
    {
        return $this->hasMany(Advertise::class);
    }

    public function bookmark()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
