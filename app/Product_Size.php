<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Size extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'product_id','size_id','quantity',
    ];
    protected $primaryKey = 'id';
    protected $table = 'products_sizes';

    public function size(){
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
}
