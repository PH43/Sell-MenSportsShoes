<?php

namespace App\Http\Controllers\Admin;
use App\Brand;
use App\Category;
use App\Product;
use App\Size;
use App\Product_Size;
use Session;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
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
        $sizes = Size::all();
        return view('admin.product.add_product')->with(compact('cate_product','brand_product', 'sizes'));
    }
    
    public function store(AddProductRequest $request)
    {
        // $this->validation($request);
        $data=$request->all();
        $data['category_id']=$request->category;
        $data['brand_id']=$request->brand;
        $data['status']=$request->status;
        $get_img= $request-> file('image');
        \DB::beginTransaction();
        try {
            if ($get_img) {
                $get_img_name=$get_img->getClientOriginalName();
                $name_img=current(explode('.',$get_img_name));
                $new_image=$name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
                $get_img->move('public/upload/product',$new_image);
                $data['image']=$new_image;
                $product=  Product::create($data);
                //add product size
                $listSize = $request->size;
                $listQuantity = $request->quantity;
                $data = [];
                foreach($listSize as $key => $value){
                    $data[] = [
                        'size_id' => $value,
                        'product_id' => $product->id,
                        'quantity' => $listQuantity[$key]
                    ];
                }
                Product_Size::insert($data);
            // cau lech dua du lieu vao DB;
            \DB::commit();
                Session::put('message','Thêm sản phẩm thành công');
                return Redirect::to('/admin/product/show-all-product');
            }
        } catch (\Exception $e) {
            \DB::rollback();
            return Redirect()->back()->with('message', 'erorr');
        }
        
    }
//Thư viện hình ảnh
    
//End thư viên   
//Size sản phẩm.
//     public function size($id){
//         $product=Product::findOrfail($id);
// <<<<<<< home_cuong
//         $all_sizes=Size::all();

//         return view('admin.size.product_sizedetials')->with(compact('product','all_sizes'));
// =======
//         $sizes=Size::all();
//         return view('admin.size.product_sizedetials', compact('product', 'sizes'));
// >>>>>>> master
    }
    public function add_size(){
        return view('admin.size.add_size');
    }
    public function add_qly_size(){
        $data=array();
        $data['product_id']=12;
        $data['size_id']=40;
        $data['quantity']=12;
        DB::table('products_sizes')->insert($data);
        // $quanly=Product::join('products_sizes','products_sizes.product_id','=','products.id')->join('sizes','products_sizes.size_id','=','sizes.id')->get()->toArray();
        dd('thanhcong');

    }
    public function create_new_size(Request $request){
            $this->validate($request,[
            'number_size' => 'required|numeric|min:1|unique:sizes,number_size'
        ],
        [
            'number_size.required' => 'Bạn chưa nhập size',
            'number_size.unique' => 'Size đã có',
            'number_size.max' => 'Size quá dài',
            'number_size.numeric' => 'Size là số',
        ]);
            $data=$request->all();
            Size::create($data);
            return Redirect::back()->with('message','Thêm size thành công');
    }
//     public function update_size_quantily(Request $request,$id){
// <<<<<<< home_cuong
//             $product=Product::findOrfail($id);

//         // return Redirect()->back()->with('message','Thêm size thành công');
// =======
//             $product = Product::findOrfail($id);
//             $listSize = $request->size;
//             $listQuantity = $request->quantity;
//             // dd($listSize,$listQuantity);
//             $data = [];
//             foreach($listSize as $key => $value){
//                 $data[] = [
//                     'size_id' => $value,
//                     'product_id' => $id,
//                     'quantity' => $listQuantity[$key]
//                 ];
//             }
//             // dd($data);
//             Product_Size::insert($data);
        
//         return redirect()->back()->with('message','Thêm size thành công');
// >>>>>>> master
//     }
//End Size

//Status sản phẩm    
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
//End Status sản phẩm
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
        $edit_product=Product::with('size')->findOrfail($id);
        // dd($edit_product->toArray());
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
    public function update(AddProductRequest $request,$id)
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
            //update product size
            $listSize = $request->size;
            $listQuantity = $request->quantity;
            $data = [];
            foreach($listSize as $key => $value){
                $data = [
                    'size_id' => $value,
                    'product_id' => $id,
                    'quantity' => $listQuantity[$key]
                ];
                Product_Size::updateOrCreate([
                    'size_id' => $value,
                    'product_id' => $id
                ],$data);
            }
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
