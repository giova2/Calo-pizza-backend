<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'contact', 'address', 'currency', 'total', 'status'
    ];

    public function orders_items()
    {
        return $this->hasMany('App\Model\OrderItem');
    }

    static function default_currency(){
        return 'EUR';
    }

    static function currencies(){
        return ['EUR', 'USD'];
    }

    static function approbed(){
        return 'approbed';
    }

    static function pending(){
        return 'pending';
    }

    static function rejected(){
        return 'rejected';
    }
}
