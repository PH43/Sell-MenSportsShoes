@extends('welcome')
@section('conten') 
                    <div class="features_items">
                    <!--features_items-->
                        @foreach($category_name as $key => $prod)
                        <h2 class="title text-center">Danh mục sản phẩm-{{$prod->category_name}}</h2>
                        @endforeach
                        @foreach($id_category as $key => $prod)
                        <div class="col-sm-4">
                            <div class="prod-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{URL::to('home/chi-tiet-sp/'.$prod->product_id)}}">
                                            <img height="200" src="{{URL::to('public/upload/product/'.$prod->product_image)}}" alt="" /></a>
                                            <h2>{{number_format($prod->product_price).' $'}}</h2>
                                            <p>{{$prod->product_name}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                       
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào iu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào so sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--features_items-->
                    
                   
@endsection                   