<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'name','desc',
    ];
    protected $primaryKey = 'id';
    protected $table = 'permissions';

    public function role(){
        return $this->belongsToMany(Roles::class,'roles_permissions','permission_id','role_id');
    }
}
