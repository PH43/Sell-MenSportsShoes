<?php

namespace App\Http\Controllers\Admin;
use App\Brand;
use App\Category;
use App\Product;
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
        $all_product=Product::with('brand','category')->orderBy('id','DESC')->paginate(5);
        foreach ($all_product as $key => $value) {
            $name=$value->brand->name;
        }
        // dd($name);
        return view('admin.product.show_all_product')->with(compact('all_product'));
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
            //tách tên ảnh với đuôi ra bởi dấu .
            $name_img=current(explode('.',$get_img_name));
            //hàm lấy tên ảnh.random từ 0-99 và thêm đuôi img ,jpn np.. phía sau
            $new_image=$name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/product',$new_image);
            $data['image']=$new_image;
            Product::create($data);
        // cau lech dua du lieu vao DB;
            Session::put('message','Thêm sản phẩm thành công');
            return response()->route('admin.show-product');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
