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
        if ($keywords!=null) {
            $search_product=Product::where('name','like','%'.$keywords.'%')
                ->paginate(6);
            return view('frontend.search.search')->with(compact('search_product'));
        }else{
            Redirect::to('/');
        }
    }

    public function show_cart()
    {
        $cart = session('cart');
        return view('frontend.cart.cart')->with(compact('cart'));   
    }
    
        public function show_product_brand($id){
        $products=Brand::findorfail($id)->join('products','products.brand_id','=','brands.id')->Where('brands.id',$id)->Where('products.status',1)->paginate(6);
        // $products=Products::where()
        $name=Brand::findorfail($id);
        if($products){
            return view('frontend.brand.show_product_brand')->with(compact('products','name')) ;
        }else{
            return view('frontend.erros.erros');
        }
        
    }
    public function show_product_category($id){
        $products=Category::findorfail($id)->join('products','products.category_id','=','categories.id')->Where('categories.id',$id)->Where('products.status',1)->paginate(6);
        $name=Category::findorfail($id);
        if($products){
            return view('frontend.category.show_product_category')->with(compact('products','name')) ;
        }else{
            return view('frontend.erros.erros');
        }
    }
    // public function reply_comment(Request $request){
    //     $data = $request->all();
    //     $comment = new Comment();
    //     $comment->comment = $data['comment'];
    //     $comment->comment_product_id = $data['comment_product_id'];
    //     $comment->comment_parent_comment = $data['comment_id'];
    //     $comment->comment_status = 0;
    //     $comment->comment_name = 'HiếuStore';
    //     $comment->save();

    // }
    // public function allow_comment(Request $request){
    //     $data = $request->all();
    //     $comment = Comment::find($data['comment_id']);
    //     $comment->comment_status = $data['comment_status'];
    //     $comment->save();
    // }
    // public function list_comment(){
    //     $comment = Comment::with('product')->where('comment_parent_comment','=',0)->orderBy('comment_id','DESC')->get();
    //     $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
    //     return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
    // }
    // public function send_comment(Request $request){
    //     $product_id = $request->product_id;
    //     $comment_name = $request->comment_name;
    //     $comment_content = $request->comment_content;
    //     $comment = new Comment();
    //     $comment->comment = $comment_content;
    //     $comment->comment_name = $comment_name;
    //     $comment->comment_product_id = $product_id;
    //     $comment->comment_status = 1;
    //     $comment->comment_parent_comment = 0;
    //     $comment->save();
    // }
    // public function load_comment(Request $request){
    //     $id = $request->id;
    //     $comment = Comment::where('product_id',$id)->where('comment_status',0)->get();
    //     $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
    //     $output = '';
    //     foreach($comment as $key => $comm){
    //         $output.= ' 
    //         <div class="row style_comment">

    //                                     <div class="col-md-2">
    //                                         <img width="100%" src="'.url('/public/frontend/images/batman-icon.png').'" class="img img-responsive img-thumbnail">
    //                                     </div>
    //                                     <div class="col-md-10">
    //                                         <p style="color:green;">@'.$comm->name.'</p>
    //                                         <p style="color:#000;">'.$comm->created_at.'</p>
    //                                         <p>'.$comm->desc.'</p>
    //                                     </div>
    //                                 </div><p></p>
    //                                 ';

    //                                 foreach($comment_rep as $key => $rep_comment)  {
    //                                     if($rep_comment->rep_comment==$comm->id)  {
    //                                  $output.= ' <div class="row style_comment" style="margin:5px 40px;background: aquamarine;">

    //                                     <div class="col-md-2">
    //                                         <img width="80%" src="'.url('/public/frontend/images/businessman.jpg').'" class="img img-responsive img-thumbnail">
    //                                     </div>
    //                                     <div class="col-md-10">
    //                                         <p style="color:blue;">@Admin</p>
    //                                         <p style="color:#000;">'.$rep_comment->comment.'</p>
    //                                         <p></p>
    //                                     </div>
    //                                 </div><p></p>';
    //                                     }
    //                                 }
    //     }
    //     echo $output;

    // }

    public function delete_cart_item($id)
    {
        
        $cartItem = CartItem::findorfail($id);
        $cartItem->delete();
     
        // Session::put('message','Xóa Phẩm Thành Công');
        return redirect()->back()->with('message','Xóa Vật Phẩm Thành Công');
    }

}
