<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'title',
        'user_id',
        'status',
        'description',
        'price'        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookmark()
    {
        return $this->belongsToMany(
            User::class,
            'bookmark',
            'product_id',
            'user_id'
        );
    }

    public function cart()
    {
        return $this->belongsToMany(
            User::class,
            'cart',
            'user_id',
            'product_id'
        );
    }
}
