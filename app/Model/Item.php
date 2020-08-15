<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 'ingredients', 'image_url', 'size', 'price', 'currency', 'status'
    ];

    public function orders_items()
    {
        return $this->hasMany('App\Model\OrderItem');
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
