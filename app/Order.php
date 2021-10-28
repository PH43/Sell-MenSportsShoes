<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderItem;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        // 'order_no',
        // 'customer_id',
        // 'customer_name',
        // 'customer_email',
        // 'customer_phone',
        // 'province_id',
        // 'district_id',
        // 'ward_id',
        // 'street',
        // 'total_amount',
        // 'sub_amount',
        // 'shipping_fee',
        // 'shipping_method_id',
        // 'payment_method_id',
        // 'status',
        'name',
        'address',
        'phone',
        'email',
        'status'
    ];

    const ORDER_STATUS = [
        'CREATED' => 1,
        'CONFIRMED' => 2,
        'SHIPPING' => 3,
        'SHIPPED' => 4,
        'COMPLETED' => 5,
    ];

    const ORDER_STATUS_MAPPING = [
        1 => 'Created',
        2 => 'Confirmed',
        3 => 'Shipping',
        4 => 'Shipped',
        5 => 'Completed',
    ];

    // protected $casts = [
    //     'total_amount' => 'float',
    //     'sub_amount' => 'float',
    //     'shipping_fee' => 'float',
    // ]; // 100000 => 100.000

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
