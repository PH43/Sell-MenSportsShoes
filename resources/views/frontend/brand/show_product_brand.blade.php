@extends('home_layout')
@section('conten') 
                    <div class="features_items">
                    <!--features_items-->
                        <h2 class="title text-center">Thương hiệu sản phẩm-{{$name->name}}</h2>
                        @foreach($products as $key => $prod)
                        <div class="col-sm-4">
                            <div class="prod-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{route('home.product-detail',$prod->id)}}">
                                            <img height="200" src="{{URL::to('public/upload/product/'.$prod->image)}}" alt="" /></a>
                                            <h2>{{number_format($prod->price).' $'}}</h2>
                                            <p>{{$prod->name}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào iu thích</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="clearfix"></div>
                    </div>
                    {!!$products->render()!!}
                    <!--features_items-->
                    
                   
@endsection                   