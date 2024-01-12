<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 'ingredients', 'image_url', 'size', 'price', 'currency', 'status'
    ];

    public function orders_items()
    {
        return $this->hasMany('App\Models\OrderItem');
    }    

    static function sizes(){
        return ['small', 'medium', 'large'];
    }
    static function default_currency(){
        return 'EUR';
    }

    static function available(){
        return 'available';
    }

    static function unavailable(){
        return 'unavailable';
    }
}
