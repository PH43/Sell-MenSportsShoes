@extends('/../admin_layout')
@section('admin_conten')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>
                        
                        <div class="panel-body">
                        		
                            <div class="position-center">
                                <form role="form" action="{{route('admin.save-new-product')}}" method="post" enctype="multipart/form-data">
                                	{{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label><span style="color:red;"> *</span>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="exampleInputEmail1" placeholder="Tên">
                                </div>

                                @if ($errors->has('name'))
                                    <p style="color:red;">{{$errors->first('name') }}</p>
                                @endif

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label><span style="color:red;"> *</span>
                                    <input type="number" name="price" value="{{ old('price') }}" class="form-control" id="exampleInputEmail1" placeholder="Giá">
                                </div>

                                @if ($errors->has('price'))
                                    <p style="color:red;">{{$errors->first('price') }}</p>
                                @endif

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label><span style="color:red;"> *</span>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1">
                                </div>

                                @if ($errors->has('image'))
                                    <p style="color:red;">{{$errors->first('image') }}</p>
                                @endif

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label><span style="color:red;"> *</span>
                                    <textarea class="form-control" style="resize: none;" rows="5" name="desc" id="ckeditor1" placeholder="Mô tả sản phẩm" >{{ old('desc') }}</textarea>
                                </div>

                                @if ($errors->has('desc'))
                                    <p style="color:red;">{{$errors->first('desc') }}</p>
                                @endif

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
                                    <label for="exampleInputEmail1">Số lượng trong kho:</label><span style="color:red;"> *</span>
                                    <input type="number" name="inventory" value="{{ old('inventory') }}" class="form-control"  id="exampleInputEmail1" placeholder="Số lượng trong kho">
                                </div>

                                @if ($errors->has('inventory'))
                                    <p style="color:red;">{{$errors->first('inventory') }}</p>
                                @endif

                                <div class="form-group">
                                	<label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="status" class="form-control input-sm m-bot15">
			                            <option value="0">Ẩn</option>
			                            <option value="1">Hiện</option>
		                       		 </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control">Add Size</label>
                                    @foreach($sizes as $key => $item)
                                    <div class="row " id="demo" >
                                        <div class="col-sm-2">
                                        <span>Size: </span>
                                        <p><input type="hidden" name="size[]"  class="form-control col-sm-11"  value="{{ $item->id }}">{{ $item->number_size }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                        <p>Quantity: </p>
                                        <input type="text" class="form-control" name="quantity[]" value="{{old('quantity.'.$key)}}" >

                                    @if ($errors->first('quantity.'.$key))
                                        
                                    <p style="color:red;">{{$errors->first('quantity.'.$key) }}</p>
                                    @endif
                                        </div>
                                        
                                    </div>
                                    @endforeach
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Thêm Sản Phẩm</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
        </div>
@endsection            