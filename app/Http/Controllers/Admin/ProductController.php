<?php

namespace App\Http\Controllers\Admin;
use App\Brand;
use App\Category;
use App\Product;
use App\Size;
use Session;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_size=Size::all();
        $all_product=Product::with('brand','category','size')->orderBy('id','DESC')->paginate(5);
        return view('admin.product.show_all_product')->with(compact('all_product','all_size'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $sortBy = $request->sort_by;
        $order = $request->order ? 'DESC': 'ASC';
        $category = $request->category; // 1
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
            $query->whereHas('category', function($query) use ($category) {
                $query->find($category);
            });
        }

        $products = $query->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate_product=Category::all();
        $brand_product=Brand::all();
        return view('admin.product.add_product')->with(compact('cate_product','brand_product'));
    }

    public function validation($request){
        return $this->validate($request,[
            'name' => 'required|max:255|min:2', 
            'price' => 'required|max:50',
            'desc' => 'required|max:255',
            'image' => 'required|max:255',
        ]);
    }
    
    public function store(AddProductRequest $request)
    {
        $this->validation($request);
        $data=$request->all();
        $data['category_id']=$request->category;
        $data['brand_id']=$request->brand;
        $data['status']=$request->status;
        $get_img= $request-> file('image');
        if ($get_img) {
            $get_img_name=$get_img->getClientOriginalName();
            $name_img=current(explode('.',$get_img_name));
            $new_image=$name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/product',$new_image);
            $data['image']=$new_image;
            Product::create($data);
        // cau lech dua du lieu vao DB;
            Session::put('message','Thêm sản phẩm thành công');
        }
    }

    public function size(){
        $product=Product::all();
        foreach ($product as $key => $pro) {
            foreach ($pro->size as $key => $value) {
                $quan=$value->pivot->quantity;
                echo $quan;
            }
                
            // $retVal = (condition) ? a : b ;
        }
    }





    public function active_product($id)
    {
        Product::findOrfail($id)->update(['status'=>1]);
            Session::put('message','Hiển Thị Sản Phẩm');
            return Redirect::to('/admin/product/show-all-product');
    }
    public function unactive_product($id)
    {
        Product::findOrfail($id)->update(['status'=>0]);
            Session::put('message','Ẩn Sản Phẩm');
            return Redirect::to('/admin/product/show-all-product'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit_product($id)
    {   
        $cate_product=Category::all();
        $brand_product=Brand::all();
        $edit_product=Product::findOrfail($id);
        $namecate=$edit_product->category->name;
        return view('admin.product.edit_product')->with(compact('edit_product','cate_product','brand_product'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $this->validation($request);
        $data=$request->all();
        $data['category_id']=$request->category;
        $data['brand_id']=$request->brand;
        $get_img= $request-> file('image');
        if ($get_img) {
            $get_img_name=$get_img->getClientOriginalName();
            $name_img=current(explode('.',$get_img_name));
            $new_image=$name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/product',$new_image);
            $data['image']=$new_image;
            Product::findOrfail($id)->update($data);
            Session::put('message','Update Sản Phẩm Thành Công');
            return Redirect::to('/admin/product/show-all-product');
        }
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_product=Product::findOrfail($id);
        $delete_product->delete();
        Session::put('message','Xóa Phẩm Thành Công');
        return Redirect::to('/admin/product/show-all-product');
    }
}
