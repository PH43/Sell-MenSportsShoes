<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'customer_id',
        'product_id',
        'name',
        'price',
        'quantity',
        'image',
        'total',
    ];

    protected $casts = [
        'price' => 'float',
    ];
}
