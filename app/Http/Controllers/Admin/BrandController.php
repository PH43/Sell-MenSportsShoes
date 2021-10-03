<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_brand=Brand::all();
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
            'name' => 'required|max:100|unique:brands|min:2', 
            'desc' => 'required|max:255',
        ]);
    }
    public function store(Request $request)
    {
        $this->validation($request);
        $data = $request->all();
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
        // $ida=$edit_brand->id;
        // dd($ida);
        if ($edit_brand) {
            return view('admin.brand.edit_brand')->with(compact('edit_brand'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $data=$request->all();
        $brand=Brand::findOrfail($id);
       
        if ($brand->name == $data['name']) {
            $brand->name = $data['name'];
            $brand->desc = $data['desc'];
            $brand->save();
            return redirect('/admin/brand/show-all-brand')->with('message','Update Thương Hiệu Thành Công');
        } else {
            $this->validation($request);
            $data_update = $request->all();
            $brand->name = $data_update['name'];
            $brand->desc = $data_update['desc'];
            $brand->save();
            return redirect('/admin/brand/show-all-brand')->with('message','Update Thương Hiệu Thành Công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand_delete=Brand::findOrfail($id);
        $brand_delete->delete();
        return redirect()->back()->with('message','Xóa Thương Hiệu Thành Công');
    }
}
