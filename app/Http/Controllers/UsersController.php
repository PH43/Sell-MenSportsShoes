<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Http\Requests;
Use Auth;
use Illuminate\Support\Facades\Redirect;
session_start();

class UsersController extends Controller
{
    public function AuthLogin(){
          $admin_id=Session::get('admin_id');
          if ($admin_id) {
               return Redirect::to('/dashboard');
             }else{
                return Redirect::to('/login')->send();
             }
        }
    public function register_auth(){
        return view('admin.users.register_auth');
    }
    public function register_save(Request $request){
        $this->validation($request);
        $data = $request->all();
        $admin = new Users();
        $admin->name = $data['admin_name'];
        $admin->phone = $data['admin_phone'];
        $admin->email = $data['admin_email'];
        $admin->flag =1;
        $admin->password = md5($data['admin_password']);
        $admin->save();
        return redirect('/login')->with('message','Đăng ký thành công');

    }
    public function validation($request){
        return $this->validate($request,[
            'admin_name' => 'required|max:255', 
            'admin_phone' => 'required|max:255', 
            'admin_email' => 'required|email|max:255', 
            'admin_password' => 'required|max:255', 
        ]);
    }
}
