<?php

namespace App\Http\Controllers;
use Roles;
use Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles=Roles::all();
        return view('admin.roles.all_roles')->with(compact('roles'));
    }
    public function add_roles(){
        $permission=Permission::all();
        return view('admin.roles.add_roles')->with(compact('permission'));
    }
    public function save_role(Request $request){
        $data=$request->all();
        $new_role= new Roles;
        $new_roles->roles_name=$request->roles_name;
        Roles::create($data);
        $new_role->permission()->attach($request->permission);
        return redirect('/admin/all_roles');
    }
}
