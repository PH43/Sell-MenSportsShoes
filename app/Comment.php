<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    // public $rep_comment = false;
    protected $fillable = [
        'name', 'desc','status','product_id','rep_comment'
    ];
    protected $primaryKey = 'id';
    protected $table = 'comments';
    public function product(){
        return $this->belongsto(Product::class,'product_id','id');
    }
}
