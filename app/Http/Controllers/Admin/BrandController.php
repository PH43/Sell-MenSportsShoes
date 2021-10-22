<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Product;
use Carbon\Carbon;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\EditBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $all_brand=Brand::where('name', 'like', '%'.request('search').'%')->paginate(20);
        } else {
            $all_brand=Brand::orderBy('id','DESC')->paginate(6);
        }
        return view('admin.brand.show_all_brand')->with(compact('all_brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.add_brand');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validation($request){
        return $this->validate($request,[
            'name' => 'required|max:100|unique:brands,name|min:2', 
            'desc' => 'required|max:255',
        ],
        [
            'name.required' => 'Bạn chưa nhập tên Thương Hiệu',
            'name.unique' => 'Thương Hiệu này đã tồn tại',
            'desc.required' => 'Bạn chưa nhập Mô Tả',
        ]);
    }
    public function store(CreateBrandRequest $request)
    {
        // $this->validation($request);
        $time=Carbon::now();
        // dd($time);
        $data = $request->all();
        $data['created_at']=$time;
        Brand::create($data);
        return redirect('/admin/brand/show-all-brand')->with('message','Thêm Thương Hiệu Mới Thành Công');
    }

    
    public function show()
    {
        //
    }

    
    public function edit($id)
    {
        $edit_brand=Brand::find($id);
        if ($edit_brand) {
            return view('admin.brand.edit_brand')->with(compact('edit_brand'));
        }else{
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {   
        $brand=Brand::findOrfail($id);
        if ($brand->name==$request->name) {
            $this->validate($request,[
            'name' => 'required|max:100', 
            'desc' => 'required|max:255'
        ],
        [
            'name.required' => 'Bạn chưa nhập tên',
            'desc.required' => 'Bạn chưa nhập Mô tả',
        ]);
            $data=$request->all();
            $brand->update($data);
            return redirect('/admin/brand/show-all-brand')->with('message','Update Thương Hiệu Thành Công');  
        }else{
            $this->validation($request);
            $data=$request->all();
            $brand->update($data);
            return redirect('/admin/brand/show-all-brand')->with('message','Update Thương Hiệu Thành Công');
        }
    }  

    public function destroy($id)
    {
        $brand_delete=Brand::findOrfail($id);

        if (Product::where('brand_id',$id)->get()->toArray()==null) {
            $brand_delete->delete();
            return redirect()->back()->with('message','Xóa Thương Hiệu Thành Công');
        } else {
             return redirect()->back()->with('message','Không thể xóa Thương Hiệu này');
        }
    }
}
