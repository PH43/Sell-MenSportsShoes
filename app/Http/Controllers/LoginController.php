<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
       return view('admin.login_admin');
    }

    public function login_dashboard(Request $request)
    {
        $this->validate($request,[
            'admin_email' => 'required|email|max:255', 
            'admin_password' => 'required|max:255'
        ]);
        if(Auth::attempt(['email'=>$request->admin_email,'password'=>$request->admin_password,'flag'=>1 ])){
            Session::put('admin_name', null);
            return redirect('/admin/dashboard');
        }else{
            return redirect('/admin/login')->with('message','Lỗi đăng nhập authentication');
        }
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/admin/login');
    }
}
