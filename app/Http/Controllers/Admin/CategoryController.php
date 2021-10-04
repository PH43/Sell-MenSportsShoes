<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            $all_category=Category::paginate(20);
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
            'name' => 'required|max:100|unique:categories|min:2', 
            'desc' => 'required|max:255',
        ]);
    }
    public function store(Request $request)
    {
        $this->validation($request);
        $data = $request->all();
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
        $data=$request->all();
        $category=Category::findOrfail($id);
       
        if ($category->name == $data['name']) {
            $category->name = $data['name'];
            $category->desc = $data['desc'];
            $category->save();
            return redirect('/admin/category/show-all-category')->with('message','Update Danh Mục Thành Công');
        } else {
            $this->validation($request);
            $data_update = $request->all();
            $category->name = $data_update['name'];
            $category->desc = $data_update['desc'];
            $category->save();
            return redirect('/admin/category/show-all-category')->with('message','Update Danh Mục Thành Công');
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
        $brand_delete->delete();
        return redirect()->back()->with('message','Xóa Danh Mục Thành Công');
    }
}
