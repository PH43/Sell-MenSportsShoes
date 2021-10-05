<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'number_size',
    ];
    protected $primaryKey = 'id';
    protected $table = 'sizes';
    public function product(){
        return $this->belongsToMany(Product::class,'products_sizes','size_id','product_id')->withPivot('quantity');
    }
}
