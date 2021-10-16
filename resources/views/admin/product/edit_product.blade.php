@extends('/../admin_layout')
@section('admin_conten')
<div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Update sản phẩm
                    </header>
                    <div class="panel-body">
                       
                        <div class="position-center">
                            <form role="form" action="{{route('admin.update-product',$edit_product->id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label><span style="color:red;"> *</span>
                                <input type="text" name="name" value="{{$edit_product->name}}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                            </div>

                            @if ($errors->has('name'))
                                <p style="color:red;">{{$errors->first('name') }}</p>
                            @endif

                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label><span style="color:red;"> *</span>
                                <input type="text" name="price" value="{{$edit_product->price}}" class="form-control" id="exampleInputEmail1" placeholder="Giá ">
                            </div>

                            @if ($errors->has('price'))
                                <p style="color:red;">{{$errors->first('price') }}</p>
                            @endif

                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label><span style="color:red;"> *</span>
                                <input type="file" name="image" class="form-control" id="exampleInputEmail1">
                                <img height="120" width="130" src="{{URL::to('public/upload/product/'.$edit_product->image)}}">
                            </div>

                            @if ($errors->has('image'))
                                <p style="color:red;">{{$errors->first('image') }}</p>
                            @endif

                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả sản phẩm</label><span style="color:red;"> *</span>
                                <textarea class="form-control" style="resize: none;" rows="5" name="product_desc" id="ckeditor2" placeholder="Mô tả sản phẩm">{{$edit_product->desc}}</textarea>
                            </div>  
                            
                            @if ($errors->has('desc'))
                                <p style="color:red;">{{$errors->first('desc') }}</p>
                            @endif

                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                <select name="category" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate_pro)
                                @if($cate_pro->id == $edit_product->category->id)
                                    <option selected value="{{$cate_pro->id}}">{{$cate_pro->name}}</option>
                                @else
                                <option value="{{$cate_pro->id}}">{{$cate_pro->name}}</option>
                                @endif  
                                @endforeach
                                 </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                <select name="brand" class="form-control input-sm m-bot15">     
                                    @foreach($brand_product as $key => $brand)
                                    @if($brand->id == $edit_product->brand->id)
                                    <option selected value="{{$brand->id}}">{{$brand->name}}</option>
                                    @else
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endif
                                    @endforeach
                                 </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượngs trong kho:</label><span style="color:red;"> *</span>
                                <input type="text" name="inventory" value="{{$edit_product->inventory}}" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm trong kho ">
                            </div>

                            @if ($errors->has('inventory'))
                                <p style="color:red;">{{$errors->first('inventory') }}</p>
                            @endif
                            <button type="submit" name="update_product" class="btn btn-info">Cập nhập sản phẩm</button>
                        </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
@endsection    