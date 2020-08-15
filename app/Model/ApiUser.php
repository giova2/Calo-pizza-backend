<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ApiUser extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable =[
        'id',
        'name',
        'lastname',
        'email',
        'avatar',
    ];

    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }
}
