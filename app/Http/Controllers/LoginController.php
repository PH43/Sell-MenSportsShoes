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

        if (Users::where('email','=',$request->admin_email)->isEmpty()) {
            return redirect('/admin/login')->with('message','Sai Email');
        }else{
            if(Users::where('password','=',md5($request->admin_password))->isEmpty()){
                return redirect('/admin/login')->with('message','Sai mật khẩu');
            }else{
                if(Auth::attempt(['email'=>$request->admin_email,'password'=>$request->admin_password,'flag'=>1 ])){
                    // Session::put('admin_name', null);
                    return redirect('/admin/dashboard');
                }else{
                    return redirect('/admin/login')->with('message','Bạn không có quyền đăng nhập dashboard');
                }
            }
        }
        // if(Auth::attempt(['email'=>$request->admin_email,'password'=>$request->admin_password,'flag'=>1 ])){
        //     Session::put('admin_name', null);
        //     return redirect('/admin/dashboard');
        // }else{
        //     return redirect('/admin/login')->with('message','Sai mật khẩu');
        // }
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/admin/login');
    }
}
