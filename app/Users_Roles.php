<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_Roles extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'role_id','user_id',
    ];
    protected $primaryKey = 'id';
    protected $table = 'users_roles';
}
