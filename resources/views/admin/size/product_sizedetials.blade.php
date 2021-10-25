@extends('admin_layout')
@section('admin_conten')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Chi Tiết Size Sản phẩm
                        </header>
                       <div class="row w3-res-tb">
                          <div class="col-sm-4 m-b-xs">
                            <a href="{{route('admin.add-size')}}" class="btn btn-sm btn-success">Thêm Size</a>         
                          </div>
                          <div class="col-sm-4 m-b-xs">
                            <label>ID Sản phẩm:{{$product->id}}</label>
                          </div>
                          <div class="col-sm-4">
                          </div>
                        </div>
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
                                <form role="form" action="{{route('admin.update-size',$product->id)}}" method="post">
                                    {{ csrf_field() }}
                                @foreach($product->size as $sizes)
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số size:{{$sizes->number_size}}</label>
                                    @if($sizes->pivot->quantity)
                                    <input type="number" name="name" value="{{$sizes->pivot->quantity}}" class="form-control" id="exampleInputEmail1" >
                                    @else
                                    <input type="number" name="name" value="0" class="form-control" id="exampleInputEmail1" >
                                    @endif
                                </div>
                                @endforeach

                                <button type="submit" name="update_size" class="btn btn-info">update size</button>
                                </form>
                            </div>
                        </div>
                    </section>

            </div>
@endsection