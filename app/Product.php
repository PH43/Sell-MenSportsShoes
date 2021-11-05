<?php

namespace App;
use App\Brand;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'price', 'desc','status','image','category_id','brand_id','inventory'
    ];
    protected $primaryKey = 'id';
    protected $table = 'products';
    protected $casts = [
        'price' => 'float',
    ];
    public function comment(){
        return $this->hasMany(Comment::class,'product_id','id');
    }
    public function gallery(){
        return $this->hasMany(Gallery::class,'product_id','id');
    }
    public function brand(){
        return $this->belongsto(Brand::class,'brand_id','id');
    }
    public function category(){
        return $this->belongsto(Category::class,'category_id','id');
    }
    public function size(){
        return $this->belongsToMany(Size::class, 'products_sizes', 'product_id', 'size_id')->withPivot('quantity');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
