<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Checkout extends Model
{
    protected $collection = 'checkouts';

    protected $fillable = [
        'user_id',
        'dish_id',
        'drink_id',
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }
}
