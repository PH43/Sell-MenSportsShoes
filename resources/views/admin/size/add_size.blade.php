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
                                 $i=1;
                               ?> 
                            <div class="position-center">
                                <form role="form" action="{{route('admin.create-new-size')}}" method="post" enctype="multipart/form-data">
                                	{{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nhập size giày:</label><span style="color:red;"> *</span>
                                    <input type="text" name="number_size" value="{{ old('number_size') }}" class="form-control" id="exampleInputEmail1" placeholder="Tên">
                                </div>
                                @if ($errors->has('number_size'))
                                    <p style="color:red;">{{$errors->first('number_size') }}</p>
                                @endif

                                <button type="submit" name="add_product" class="btn btn-info">Thêm Size</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
        </div>
@endsection            