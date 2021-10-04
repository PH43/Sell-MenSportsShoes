@extends('admin_layout')
@section('admin_conten')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập Nhập Danh Mục
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
                                <form role="form" action="{{route('update-category', $edit_category->id)}}" method="post">
                                	{{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{$edit_category->name}}"  name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea class="form-control"  style="resize: none;" rows="5" name="desc" id="ckeditor5" placeholder="Mô tả danh mục" required>{{$edit_category->desc}}</textarea>
                                </div>
                                <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhập danh mục</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
        </div>
@endsection            