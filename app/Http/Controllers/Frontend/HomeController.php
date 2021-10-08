<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\Brand;
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
        $id_category=$product_detail->category->id;
        $sizes=Size::all();

        // $product_lienquan=Category::join('product')->Where('products.status',1)->whereNotin('products.id',[$id])->get();
        $product_lienquan=DB::table('products')
            ->join('categories','categories.id','=','products.category_id')
            ->where('categories.id',$id_category)
            ->Where('products.status',1)
            ->whereNotin('products.id',[$id])
            ->paginate(3);
        return view('frontend.home.product_detail')->with(compact('product_lienquan','product_detail','sizes'));

    }
    
    public function login_register_customer(){
        return view('frontend.home.register_customer');
    }
    public function validation($request){
        return $this->validate($request,[
            'name' => 'required|max:50|min:4', 
            'phone' => 'required|max:20|min:8', 
            'email' => 'required|email|max:60', 
            'password' => 'required|max:225', 
        ]);
    }
    public function add_customer(Request $request){
        $this->validation($request);
        $data = $request->except('_token');
        // dd($data);
        $data['flag'] =0;
        $data['password'] = md5($data['password']);
        // DB::table('users')->insertGetId($data);
        $id=Users::insertGetId($data);
        Session::put('customer_id',$id);
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
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password ])){
            return redirect('/');
        }else{
            return redirect()->back()->with('message','Lỗi đăng nhập');
        }
    }

    public function logout(){
        Auth::logout();
        Session::put('customer_id',null);
        return Redirect::to('/');
    }
}