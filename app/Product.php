<?php

namespace App;
use App\Brand;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'desc','status','image','category_id','brand_id'
    ];
    public function brand(){
        eturn $this->belongsto(Brand::class,'brand_id','id');
    }
    public function category(){
        eturn $this->belongsto(Category::class,'category_id','id');
    }
}
