<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Users;
use App\Roles;
use App\Http\Requests;
Use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Session;


class UsersController extends Controller
{
    public function register_auth(){
        return view('admin.users.register_auth');
    }
    public function validation($request){
        return $this->validate($request,[
            'name' => 'required|max:50|min:10', 
            'phone' => 'required|max:20|min:8', 
            'email' => 'required|email|max:60', 
            'password' => 'required|max:225', 
        ]);
    }
    public function register_save(Request $request){
        $this->validation($request);
        $data = $request->all();
        $data['flag'] =1;
        $data['password'] = md5($data['password']);
        Users::create($data);
        return redirect('/admin/login')->with('message','Đăng ký thành công');
    }
    
    public function index_users(){
         $admin = Users::with('roles')->orderBy('id','DESC')->paginate(4);
        return view('admin.users.all_users')->with(compact('admin'));
    }
    public function delete_user_roles($admin_id){
        if(Auth::id()==$admin_id){
            return redirect()->back()->with('message','Bạn không được quyền xóa chính mình');
        }
        $users = Users::find($admin_id);
        if($users){
            $users->roles()->detach();
            $users->delete();
        }
        return redirect()->back()->with('message','Xóa user thành công');

    }
    public function assign_roles(Request $request){
        if(Auth::id()==$request->admin_id){
            return redirect()->back()->with('message','Bạn không được phân quyền chính mình');
        }

        $user = Users::where('email',$request->admin_email)->first();
        $user->roles()->detach();

        if($request->sub_admin_role){
            // detach()->ngược lại với attach()
           $user->roles()->attach(Roles::where('roles_name','sub_admin')->first());     
        }
        if($request->shipper_role){
           $user->roles()->attach(Roles::where('roles_name','shipper')->first());     
        }
        if($request->admin_role){
           $user->roles()->attach(Roles::where('roles_name','admin')->first());     
        }
        return redirect()->back()->with('message','Cấp quyền thành công');
    }
     public function add_users(){
        return view('admin.users.add_users');
    }
    public function store_users(Request $request){
        $data = $request->all();
        $data['password'] = md5($request->password);
        $data['flag']=1;
        Users::create($data)->roles()->attach(Roles::where('roles_name','sub_admin')->first());
        Session::put('message','Thêm users thành công');
        return Redirect::to('admin/all-users');
    }
}
