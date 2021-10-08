<?php

namespace App\Http\Controllers\Frontend;

use App\Product;
use App\Category;
use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        // dd('Tuan');
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

    public function addToCart(Request $request)
    {
        $productId = $request->productId;

        // 
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
    public function show_product_brand($id){
        $products=Brand::findorfail($id)->join('products','products.brand_id','=','brands.id')->Where('brands.id',$id)->Where('products.status',1)->paginate(6);
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

}
