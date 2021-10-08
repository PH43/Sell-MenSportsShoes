@extends('welcome')
@section('conten') 
<div class="product-details"><!--product-details-->
	@foreach($details_product as $key => $value)
	<div class="col-sm-5">
		<div class="view-product">
			<img src="{{URL::to('public/upload/product/'.$value->product_image)}}" alt="" />
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
			<img src="{{URL::to('public/frontend/images/new.jpg')}}" class="newarrival" alt="" />
			<h2>{{$value->product_name}}</h2>
			<p>{{$value->product_id}}</p>
			<img src="{{URL::to('public/frontend/images/rating.png')}}" alt="" />

			<form method="POST" action="{{URL::to('/home/show-cart')}}">
				{{ csrf_field() }}
				<!-- {{ method_field('POST') }} -->
				<span>
					<span>{{number_format($value->product_price).' '.'$'}}</span>
					<label>Số lượng:</label>
					<input name="qty" type="number" min="1" max="10" required="">
					<input type="hidden" name="ProductId_hidden" value="{{$value->product_id}}">
					<button type="submit" class="btn btn-fefault cart">
						<i class="fa fa-shopping-cart"></i>
						Add to cart
					</button>
				</span>
			</form>
			<p><b>Tình Trạng Sản Phẩm:</b>Còn hàng/Hết hàng</p>
			<p><b>Điều kiện:</b>Hàng mới 100%</p>
			<p><b>Thương hiệu sản phẩm:</b>{{$value->brand_name}}</p>
			<p><b>Danh mục sản phẩm:</b>{{$value->category_name}}</p>
			<a href="#"><img src="{{URL::to('public/frontend/images/share.png')}}" class="share img-responsive"  alt="" /></a>
		</div><!--/product-information-->
	</div>
	@endforeach
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
			<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm/Thông số kỹ thuật</a></li>
			<li><a href="#reviews" data-toggle="tab">Đánh giá sản phẩm</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade active in" id="details" >
			<div class="col-sm-7">
				<p>{!!$value->product_desc!!}</p>
			</div> 
		</div> 

		
		<div class="tab-pane fade " id="companyprofile" >
			<div class="col-sm-7">
				<p>{!!$value->product_content!!}</p>
			</div> 
		</div>
				
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
                                <a href="{{URL::to('home/chi-tiet-sp/'.$lienquan->product_id)}}">
                                <img height="200" src="{{URL::to('public/upload/product/'.$lienquan->product_image)}}" alt="" /></a>
                                <h2>{{number_format($lienquan->product_price).' $'}}</h2>
                                <p>{{$lienquan->product_name}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="item">
			</div>		
			@endforeach
		</div>
		 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		  </a>
		  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
		  </a>			
	</div>
</div><!--/recommended_items-->
@endsection

