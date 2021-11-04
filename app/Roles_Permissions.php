<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles_Permissions extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'role_id','permission_id',
    ];
    protected $primaryKey = 'id';
    protected $table = 'roles_permissions';
    public function role(){
        return $this->belongsTo(Roles::class, 'role_id', 'id');
    }
}
