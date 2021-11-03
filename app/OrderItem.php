<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        // 'order_id',
        // 'customer_id',
        // 'product_id',
        // 'name',
        // 'price',
        // 'quantity',
        // 'image',
        // 'total',
        'product_id',
        'product_name',
        'price',
        'quantity',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function size() {
        return $this->hasOne(Size::class, 'id', 'size');
    }
}
