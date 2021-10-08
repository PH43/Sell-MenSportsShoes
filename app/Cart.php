<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CartItem;

class Cart extends Model
{
    protected $fillable = [
        'coupon_id',  'customer_id','subtotal','total'
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }

}
