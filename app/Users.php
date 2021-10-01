<?php

namespace App;
use App\Roles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    public $timestamps = false;
    protected $fillable = [
          'name',  'email', 'password','phone','flag'
    ];
    protected $primaryKey = 'id';
    protected $table = 'users';
    public function roles(){
        return $this->belongsToMany(Roles::class,'users_roles','user_id','role_id');
    }
    public function hasAnyRoles($roles){
        return null !==  $this->roles()->whereIn('roles_name',$roles)->first();
    }
    public function hasRole($role){
        return null !==  $this->roles()->where('roles_name',$role)->first();
    }
    
}
