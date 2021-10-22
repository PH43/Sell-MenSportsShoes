<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role_permission extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'role_id','permission_id',
    ];
    protected $primaryKey = 'id';
    protected $table = 'roles_permissions';
}
