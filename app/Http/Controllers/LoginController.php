<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class LoginController extends Controller
{
    //không cho đăng nhập vào dashboard
    public function AuthLogin(){
      $admin_id=Session::get('admin_id');
      if ($admin_id) {
           return Redirect::to('/dashboard');
         }else{
            return Redirect::to('/login')->send();
         }
    }

    public function index(){
       return view('admin.login_admin');
    }
    public function show_dashboard(){
       $this->AuthLogin();
       return view('admin_layout');
    }
    public function login_dashboard(Request $request){
      $admin_email = $request->admin_email;
      $admin_password=md5($request->admin_password);
      // dd($admin_password);
      $result =Users::all()->where('email',$admin_email)->where('password',$admin_password)->where('flag',1)->first(); // first de goi ra 1 users
      if ($result==true) {
         Session::put('admin_name',$result->name);
         Session::put('admin_id',$result->id);
         Session::put('admin_password',$result->password);
         return Redirect::to('/dashboard');
      }else{
         Session::put('message','mật khẩu hoặc email nhập sai');
         return Redirect::to('/login');
      }
    }
    public function logout(){
         $this->AuthLogin();
         Session::put('admin_name',null);
         Session::put('admin_id',null);
         return Redirect::to('/login');
          }
}
