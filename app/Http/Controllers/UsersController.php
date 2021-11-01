<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Roles;
use App\Http\Requests;
Use Auth;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Http\Requests\CreateUserRequest;


class UsersController extends Controller
{
    public function register_auth(){
        return view('admin.users.register_auth');
    }
    public function validation($request){
        return $this->validate($request,[
            'name' => 'required|max:50|min:4', 
            'phone' => 'required|max:20|min:8', 
            'email' => 'required|email|unique:users,email|max:60', 
            'password' => 'required|max:225', 
        ],
        [
            'name.required' => 'Bạn chưa nhập tên thành viên',
            'email.required' => 'Bạn chưa nhập email',
            'email.unique' => 'Email này đã tồn tại',
            'password.required' => 'Bạn chưa nhập Mật khẩu',
        ]);
    }
    public function register_save(Request $request){
        $this->validation($request);
        $data = $request->all();
        $data['flag'] =1;
        $data['password'] = bcrypt($data['password']);
        Users::create($data);
        return redirect('/admin/login')->with('message','Đăng ký thành công');
    }
    
    public function index_users(){
         $admin = Users::with('roles')->where('flag',1)->orderBy('id','DESC')->paginate(4);
        return view('admin.users.all_users')->with(compact('admin'));
    }
    public function index_customer(){
         $admin = Users::where('flag',0)->orderBy('id','DESC')->paginate(4);
        return view('customer.all_customer')->with(compact('admin'));
    }
    public function delete_customer($id){
        $users = Users::find($id);
        $users->delete();
        return redirect()->back()->with('message','Xóa user thành công');
    }
    public function delete_user_roles($id){
        if(Auth::id()==$id){
            return redirect()->back()->with('message','Bạn không được quyền xóa chính mình');
        }
        $users = Users::find($id);
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
    public function store_users(CreateUserRequest $request){
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['flag']=1;
        Users::create($data);
        Session::put('message','Thêm users thành công');
        return Redirect::to('admin/all-users');
    }
     public function edit_users($id){

        $edit_user=Users::findorfail($id);

        return view('admin.users.edit_user')->with(compact('edit_user'));
    }
    public function update_user(Request $request,$id){

        
        $edit_user=Users::findorfail($id);
        if ($edit_user->email== $request->email) {
            $data=$request->all();
            $data['password'] = md5($request->password);
            $data['flag']=1;
            $edit_user->update($data);
        }else{
            $this->validation($request);
            $data=$request->all();
            $data['password'] = md5($request->password);
            $data['flag']=1;
            $edit_user->update($data);
        }
        return Redirect::to('admin/all-users')->with('message','Update thành công');
    }
}
