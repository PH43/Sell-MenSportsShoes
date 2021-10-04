<?php

namespace App;
use App\Brand;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'price', 'desc','status','image','category_id','brand_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'products';
    public function brand(){
        return $this->belongsto(Brand::class,'brand_id','id');
    }
    public function category(){
        return $this->belongsto(Category::class,'category_id','id');
    }
}
