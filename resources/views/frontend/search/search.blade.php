@extends('home_layout')
@section('conten') 
                    <div class="features_items">
                    <!--features_items-->
                        <h2 class="title text-center">Kết quả tìm kiếm</h2>
                        @foreach($search_product as $key => $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{route('home.product-detail',$product->id)}}">
                                            <img height="200" src="{{URL::to('public/upload/product/'.$product->image)}}" alt="" /></a>
                                            <h2>{{number_format($product->price).' đ'}}</h2>
                                            <p>{{$product->name}}</p>
                                            <a href="{{route('home.add-to-cart',$product->id)}}" class="btn btn-default add-to-cart" data-product-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
                    </div><!--features_items-->
                    {!!$search_product->render()!!}
                          
@endsection                   