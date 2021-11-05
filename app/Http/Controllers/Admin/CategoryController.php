<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin.category.index');
        if (request('search')) {
            $all_category=Category::where('name', 'like', '%'.request('search').'%')->paginate(20);
        } else {
            $all_category=Category::orderBy('id','DESC')->paginate(6);
        }
        return view('admin.category.show_all_category')->with(compact('all_category'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add_category');
    }

    public function validation($request){
        return $this->validate($request,[
            'name' => 'required|max:100|unique:categories,name|min:2', 
            'desc' => 'required|max:255',
        ],
        [
            'name.required' => 'Bạn chưa nhập tên Danh mục',
            'name.unique' => 'Danh mục này đã tồn tại',
            'desc.required' => 'Bạn chưa nhập Mô Tả',
        ]);
    }
    public function store(CreateCategoryRequest $request)
    {
        $time=Carbon::now();
        $data = $request->all();
        $data['created_at']=$time;
        // dd($data['created_at']);
        Category::create($data);
        return redirect('/admin/category/show-all-category')->with('message','Thêm Danh Mục Mới Thành Công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_category=Category::findOrfail($id);
        if ($edit_category) {
            return view('admin.category.edit_category')->with(compact('edit_category'));
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
        $category=Category::findOrfail($id);

       if ($category->name==$request->name) {
            $this->validate($request,[
            'name' => 'required|max:100', 
            'desc' => 'required|max:255'
        ],
        [
            'name.required' => 'Bạn chưa nhập tên',
            'desc.required' => 'Bạn chưa nhập Mô tả',
        ]);
            $data=$request->all();
            $category->update($data);
            return redirect('/admin/category/show-all-category')->with('message','Update danh mục thành công');  
        }else{
            $this->validation($request);
            $data=$request->all();
            $category->update($data);
            return redirect('/admin/category/show-all-category')->with('message','Update danh mục thành công');
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
        $brand_delete=Category::findOrfail($id);
        $xoa=Product::where('category_id',$id)->get()->toArray();
         if ($xoa==null) {
            $brand_delete->delete();
            return redirect()->back()->with('message','Xóa Danh Mục Thành Công');
        } else {
             return redirect()->back()->with('message','Không thể xóa Danh mục này');
        }     
    }
}
