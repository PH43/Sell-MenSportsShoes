@extends('home_layout')
@section('conten') 
<div class="product-details"><!--product-details-->
	<div class="col-sm-5">
		<div class="view-product">
			<img src="{{URL::to('public/upload/product/'.$product_detail->image)}}" alt="" />
			<h3>ZOOM</h3>
		</div>
		<div id="similar-product" class="carousel slide" data-ride="carousel">
			
			  <!-- Wrapper for slides -->
			    <div class="carousel-inner">
					<div class="item active">
					  <a href=""><img src="{{URL::to('/public/frontend/images/similar1.jpg')}}" alt=""></a>
					  <a href=""><img src="{{URL::to('/public/frontend/images/similar2.jpg')}}" alt=""></a>
					 <a href=""><img src="{{URL::to('/public/frontend/images/similar3.jpg')}}" alt=""></a>
					</div>			
				</div>

			  <!-- Controls -->
			  <a class="left item-control" href="#similar-product" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			  </a>
			  <a class="right item-control" href="#similar-product" data-slide="next">
				<i class="fa fa-angle-right"></i>
			  </a>
		</div>
	</div>
	<div class="col-sm-7">
		<div class="product-information"><!--/product-information-->
			<!-- <img src="{{URL::to('public/frontend/images/new.jpg')}}" class="newarrival" alt="" /> -->
			<h2>{{$product_detail->name}}</h2>
			<form method="POST" action="{{URL::to('/home/show-cart')}}">
				{{ csrf_field() }}
				<!-- {{ method_field('POST') }} -->
				<span>
					<span>{{number_format($product_detail->price).' '.'đ'}}</span><br><br>

					<label id="size">Size:</label>
					<select style="width: 50px" name="number_size">
						@foreach($sizes as $size )
						<option  value="{{$size->id}}">{{$size->number_size}}</option>
						@endforeach
					</select>
					<br><br>
					<label id="size">Số lượng:</label>
					<input name="qty" type="number" min="1" max="10" value="1" required="">
					<input type="hidden" name="ProductId_hidden" value="{{$product_detail->id}}"><br><br>
					<button type="submit" class="btn btn-fefault cart">
						<i class="fa fa-shopping-cart"></i>
						Add to cart
					</button>
				</span>
			</form>
			<p><b>Hàng mới 100%</b></p>
			<p><b>Thương hiệu:</b><a href="">{{$product_detail->brand->name}}</a></p>
			<p><b>Danh mục:</b><a href="">{{$product_detail->category->name}}</a></p>
			<a href="#"><img src="{{URL::to('public/frontend/images/share.png')}}" class="share img-responsive"  alt="" /></a>
		</div><!--/product-information-->
	</div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
<!-- 			<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm/Thông số kỹ thuật</a></li> -->
			<li><a href="#reviews" data-toggle="tab">Đánh giá sản phẩm</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade active in" id="details" >
			<div class="col-sm-7">
				<h2 id="desc">{!!$product_detail->desc!!}</h2>
			</div> 
		</div> 

		
		<!-- <div class="tab-pane fade " id="companyprofile" >
			<div class="col-sm-7">
				<p>  </p>
			</div> 
		</div> -->
				
		<div class="tab-pane fade" id="reviews" >
			<div class="col-sm-12">
				<ul>
					<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
					<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
					<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
				</ul>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
				<p><b>Write Your Review</b></p>
				
				<form action="#">
					<span>
						<input type="text" placeholder="Your Name"/>
						<input type="email" placeholder="Email Address"/>
					</span>
					<textarea name="" ></textarea>
					<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
					<button type="button" class="btn btn-default pull-right">
						Submit
					</button>
				</form>
			</div>
		</div>
		
	</div>
</div><!--/category-tab-->

<div class="recommended_items"><!--recommended_items-->
	<h2 class="title text-center">Sản phẩm liên quan</h2>
	
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			@foreach($product_lienquan as $key => $lienquan)
			<div class="item active">
				<div class="col-sm-4">
                    <div class="prod-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{route('home.product-detail',$lienquan->id)}}">
                                <img height="200" src="{{URL::to('public/upload/product/'.$lienquan->image)}}" alt="" /></a>
                                <h2>{{number_format($lienquan->price).' đ'}}</h2>
                                <p>{{$lienquan->name}}</p>
                                <a href="{{route('home.add-to-cart',$lienquan->id)}}" class="btn btn-default add-to-cart" data-product-id="{{ $lienquan->id }}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="item">
			</div>		
			@endforeach
		</div>
		 {!!$product_lienquan->render()!!}			
	</div>
</div><!--/recommended_items-->
@endsection

