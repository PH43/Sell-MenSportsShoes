<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
     public $timestamps = false;
    protected $fillable = [
          'roles_name'
    ];
    protected $primaryKey = 'id';
    protected $table = 'roles';
    public function users(){
        return $this->belongsManyTo('App\Users');
    }
}
