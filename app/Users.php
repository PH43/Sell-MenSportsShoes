<?php

namespace App;

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
        return $this->belongsManyTo('App\Roles');
    }
    
}
