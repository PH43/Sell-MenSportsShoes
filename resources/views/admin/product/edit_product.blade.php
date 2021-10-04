@extends('/../admin_layout')
@section('admin_conten')
<div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Update sản phẩm
                    </header>
                    <div class="panel-body">
                        <?php
                            $message=Session::get('message');
                            if ($message) {
                                echo '<span class="textalert">'.$message.'</span>';
                                Session::put('message',null);
                             }
                         ?> 
                        <div class="position-center">
                            @foreach($edit_product as $key => $product)
                            <form role="form" action="{{('/update-product/'.$product->product_id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" name="product_name" value="{{$product->product_name}}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="text" name="product_price" value="{{$product->product_price}}" class="form-control" id="exampleInputEmail1" placeholder="Giá ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                <img height="120" width="130" src="{{URL::to('public/upload/product/'.$product->product_image)}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                <textarea class="form-control" style="resize: none;" rows="5" name="product_desc" id="ckeditor2" placeholder="Mô tả sản phẩm">{{$product->product_desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                <textarea class="form-control" style="resize: none;" rows="5" name="product_content" id="ckeditor3" placeholder="Nộ dung sản phẩm">{{$product->product_content}}</textarea>
                            </div>
                                
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($category_product as $key => $cate_product)
                                @if($cate_product->category_id == $product->category_id)
                                    <option selected value="{{$cate_product->category_id}}">{{$cate_product->category_name}}</option>
                                @else
                                <option value="{{$cate_product->category_id}}">{{$cate_product->category_name}}</option>
                                @endif   
                                @endforeach
                                 </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                <select name="product_brand" class="form-control input-sm m-bot15">     
                                    @foreach($brand_product as $key => $brand)
                                    @if($brand->brand_id == $product->brand_id)
                                    <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @else
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endif
                                    @endforeach
                                 </select>
                            </div>
                            <button type="submit" name="update_product" class="btn btn-info">Cập nhập sản phẩm</button>
                            @endforeach
                        </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
@endsection    