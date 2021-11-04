<?php

namespace App;
use App\Users;
use App\Permission;
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
        return $this->belongsToMany(Users::class,'users_roles','role_id','user_id');
    }
    public function permission(){
        return $this->belongsToMany(Permission::class,'roles_permissions','role_id','permission_id');
    }
}
