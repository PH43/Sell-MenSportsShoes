@extends('admin_layout')
@section('admin_conten')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh thương hiệu sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{route('save-new-brand-product')}}" method="post">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                        </div>
                        
                        @if ($errors->has('name'))
                            <p style="color:red;">{{$errors->first('name') }}</p>
                        @endif

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea class="form-control" style="resize: none;" rows="5" name="desc" id="ckeditor6"placeholder="Mô tả thương hiệu"></textarea>
                        </div>

                        @if ($errors->has('desc'))
                            <p style="color:red;">{{$errors->first('desc') }}</p>
                        @endif
                
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

                </div>
            </section>
    </div>
</div>
@endsection            