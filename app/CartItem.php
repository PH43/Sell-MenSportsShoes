<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id', 'product_id', 'name', 'price', 'image', 'quantity','size'
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function size() {
        return $this->hasOne(Size::class, 'id', 'size');
    }
}
