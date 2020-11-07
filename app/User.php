<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'company',
        'role',
        'password',
        'state'
    ];

    protected $hidden = [
        'id'
    ];

    public function advertise()
    {
        return $this->hasMany(Advertise::class);
    }

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class);
    }

    public function bookmark()
    {
        return $this->belongsToMany(
            Products::class,
            'bookmark',
            'user_id',
            'product_id'
        );
    }

    public function cart()
    {
        return $this->belongsToMany(
            Products::class,
            'cart',
            'user_id',
            'product_id'
        );
    }
}
