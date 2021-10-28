<?php

namespace App\Http\Controllers\Frontend;
// use App\Http\Controllers;
use App\Product;
use App\Category;
use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Services\AddToCartService;
use App\Http\Requests\AddToCartRequest;
use App\Cart;
use App\CartItem;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $sortBy = $request->sort_by;
        $order = $request->order ? 'DESC': 'ASC';
        $category = $request->category;
        if( $request->has('search') && !empty($search))
        {
            $query = Product::where('name', 'like',"%$search%")
            ->orWhere('desc', 'like',"%$search%");
        }
        if( $request->has('sort_by') && !empty($sortBy) && !empty($order))
        {
            $query->orderBy($sortBy, $order);
        }
        if( $request->has('category') && !empty($category))
        {
            $query->whereHas('category', function($query) use ($category){
                $query->find($id);
            });
        }

        $products = $query->get();
    }

    public function addToCart(AddToCartRequest $request, AddToCartService $cartService)
    {
        $productId = $request->productId;
        $quantity = $request->quantity ?? 1;
        $product = Product::find($productId);
        if ($product->inventory > 0 && $quantity < $product->inventory) {
            if (session()->has('cart')) {
                $cartService->updateCart($productId, $quantity, session('cart'));
            } else {
                $cart = $cartService->addToCart($productId, $quantity);
                session(['cart' => $cart]);
            }
            return response()->json(['status' => 200, 'message' => 'Thêm vào giỏ hàng thành công!']);
        }
        return response()->json(['status' => 201, 'message' => 'Sản phẩm không đủ trong kho!']);
    }

    public function search_pc(Request $request){
        $keywords=$request->keywords_submit;
        $search_product=Product::where('status',1)->where('name','like','%'.$keywords.'%')->orWhere('desc','like','%'.$keywords.'%')->paginate(6);
        if ($keywords!=null) {
            if($search_product->isNotEmpty()){
                return view('frontend.search.search')->with(compact('search_product')); 
            }else{
                return view('frontend.erros.search_ero');  
            }
        }else{
            return redirect()->back();
        }
    }

    public function timkiem_ajax(Request $request){
        $data = $request->all();
        if($data['query']){
            $product = Product::where('status',1)->where('name','LIKE','%'.$data['query'].'%')->orWhere('desc', 'like','%'.$data['query'].'%')->paginate(6);
            $product_ajax = Product::where('status',1)->where('name','LIKE','%'.$data['query'].'%')->orWhere('desc', 'like','%'.$data['query'].'%')->get()->toArray();
            if ($product->isEmpty()) {
                $output ='
                <ul class="dropdown-menu" style="display:block; position:relative">
                <li class="li_search_ajax">Không tìm thấy sản phẩm </li>
                ';
            }
            else{
               $output = '
                <ul class="dropdown-menu" style="display:block; position:relative">';
                foreach($product as $key => $val){
                    $output .= '
                     <li class="li_search_ajax"><img style="width:50px" src="'.url('/public/upload/product/',$val->image ).'"><a style="display:inline" href="'.route('home.product-detail',$val->id ).'">'.$val->name.'</a></li>
                     ';      
                } 
                $output .= '</ul>'; 
            }
            // dd($output);
            echo $output;  
        }
    }

    public function show_cart()
    {
        $cart = session('cart');
        return view('frontend.cart.cart')->with(compact('cart'));   
    }
    
        public function show_product_brand($id){
        $products=Product::where('status',1)->where('brand_id',$id)->paginate(6);
        $name=Brand::findorfail($id);


        if( $products->isEmpty()){
            return view('frontend.erros.erros');
        }else{
            return view('frontend.brand.show_product_brand')->with(compact('products','name')) ;
        } 
    }
    public function show_product_category($id){
        $products=Product::where('status',1)->where('category_id',$id)->paginate(6);
        $name=Category::findorfail($id);
        if($products->isEmpty()){
             return view('frontend.erros.erros');
        }else{
            return view('frontend.category.show_product_category')->with(compact('products','name')) ;
           
        }
    }

    public function delete_cart_item($id)
    {
        
        $cartItem = CartItem::findorfail($id);
        $cartItem->delete();
     
        // Session::put('message','Xóa Phẩm Thành Công');
        return redirect()->back()->with('message','Xóa Vật Phẩm Thành Công');
    }

}
