<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\Brand;
use App\Gallery;
use App\Users;
use App\Size;
use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =Product::where('status',1)->orderBy('id','DESC')->paginate(6);
        return view('frontend.home.home')->with(compact('products'));
    }
    public function product_detail($id){
        $product_detail = Product::findOrfail($id);
        if ($product_detail->status==1) {
            $gallery=Gallery::where('product_id','=',$id)->get();
            $id_category=$product_detail->category->id;
            $sizes=Size::all();
            $product_lienquan=Product::where('category_id',$id_category)->Where('status',1)->whereNotin('id',[$id])->paginate(3);
            return view('frontend.home.product_detail')->with(compact('product_lienquan','product_detail','sizes','gallery'));
        }else{
            return Redirect()->back();
        }
    }
    
    public function login_register_customer(){
        return view('frontend.home.register_customer');
    }
    public function validation($request){
        return $this->validate($request,[
            'name' => 'required|max:50|min:4', 
            'phone' => 'required|unique:users,phone|numeric|digits:10', 
            'email' => 'required|email|unique:users,email|max:60', 
            'password' => 'required|max:225|min:6',
        ],
        [
            'name.required' => 'Bạn chưa nhập tên thành viên',
            'name.max' => 'Tên quá dài',
            'email.required' => 'Bạn chưa nhập email',
            'email.unique' => 'Email này đã tồn tại',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.digits' => 'Số điện thoại phải là 10 số',
            'phone.numeric' => 'Số điện thoại không dc nhập chữ',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Bạn chưa nhập Mật khẩu',
            'password.min' => 'Mật khẩu quá ngắn',
        ]);
    }
    public function add_customer(Request $request){
        $this->validation($request);
        $data = $request->except('_token');
        $data['flag'] =0;
        $data['password'] = md5($data['password']);
        $id=Users::insertGetId($data);
        $name=Users::findorfail($id);
        Session::put('customer_id',$id);
        Session::put('customer_name',$name->name);
        if ($id) {
            return redirect('/');
        }else{
            return redirect()->back()->with('message','Lỗi đăng kí');
        } 
    }
    public function login_customer(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|max:255', 
            'password' => 'required|max:255'
        ],
        [
            'email.required' => 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập Mật khẩu',
        ]);
        $email=$request->email;
        // $password=($request->password);
        // dd($password);
        $kiemtramail=Users::where('email','=',$email)->get()->toArray();
        // if (!Users::where('email','=',$request->email)->first()) {
        //     return redirect()->back()->with('message','Email không đúng');
        // } else {
        //     if(Auth::attempt(['email'=>$request->email, 'password'=> $request->password])){
        //         return redirect('/');
        //         Session::put('customer_id',$login->id);
        //         Session::put('customer_name',$login->name);
        //     }else{
        //         return redirect()->back()->with('message','Password không đúng');
        //     }
        // }
        if ($kiemtramail==null) {
            return redirect()->back()->with('message','Email không tồn tại');
        }else{
            $login=Users::where('email','=',$email)->Where('password','=',md5($request->password))->first();
            // dd($login);
            if($login){
                Session::put('customer_id',$login->id);
                Session::put('customer_email',$login->email);
                Session::put('customer_phone',$login->phone);
                Session::put('customer_name',$login->name);
                return redirect('/');
            }else{
                return redirect()->back()->with('message','Sai mật khẩu');
            }
        }
    }

    public function logout(){
        // Auth::logout();
        Session::put('customer_id',null);
        Session::put('customer_name',null);
        return Redirect::to('/');
    }
}