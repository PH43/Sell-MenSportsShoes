@extends('/../admin_layout')
@section('admin_conten')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
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
                                <form role="form" action="{{route('admin.save-new-product')}}" method="post" enctype="multipart/form-data">
                                	{{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="number" name="price" class="form-control" id="exampleInputEmail1" placeholder="Giá" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea class="form-control" style="resize: none;" rows="5" name="desc" id="ckeditor1" placeholder="Mô tả sản phẩm" required></textarea>
                                </div>
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="category" class="form-control input-sm m-bot15">
                                    	@foreach($cate_product as $key => $cate_pro)
			                            <option value="{{$cate_pro->id}}">{{$cate_pro->name}}</option>
			                            @endforeach
		                       		 </select>
                                </div>
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                    <select name="brand" class="form-control input-sm m-bot15">
                                    	@foreach($brand_product as $key => $brand_pro)
			                            <option value="{{$brand_pro->id}}">{{$brand_pro->name}}</option>
			                            @endforeach
		                       		 </select>
                                </div>
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="status" class="form-control input-sm m-bot15">
			                            <option value="0">Ẩn</option>
			                            <option value="1">Hiện</option>
		                       		 </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Thêm Sản Phẩm</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
        </div>
@endsection            