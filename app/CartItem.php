<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id', 'product_id', 'name', 'price', 'image', 'quantity'
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
