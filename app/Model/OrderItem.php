<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'item_id', 'quantity'
    ];

    public function order()
    {
        return $this->belongsTo('App\Model\Order');
    }

    public function item()
    {
        return $this->belongsTo('App\Model\Item');
    }

}
