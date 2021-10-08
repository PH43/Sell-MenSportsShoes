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


        // $product_lienquan=Product::with('category')->Where('products.status',1)->orWhere('categories.id',$id_category)->whereNotin('products.id',[$id])->get();
        // echo ($product_lienquan);
        return view('frontend.home.product_detail')->with(compact('product_lienquan','product_detail','sizes'));

    }
    public function detail_product($product_id){
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
            ->where('tbl_product.product_id',$product_id)->get();
         foreach ($all_product as $key => $value) {
                $category_id=$value->category_id;
            }   
        $product_lienquan=DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            ->where('tbl_category_product.category_id',$category_id)
            ->whereNotin('tbl_product.product_id',[$product_id])
            ->get(); 
        return view('pages.product.detail_product')->with('details_product',$all_product)->with('product_lienquan',$product_lienquan);
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