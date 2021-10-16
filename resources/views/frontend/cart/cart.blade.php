@extends('home_layout')
@section('conten')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>

					
					@php
					$subtotal=0
					@endphp
                        @foreach($cart->cartItems()->get() as $cartItem)
							@php
								$total= ($cartItem->price * $cartItem->quantity);
								$subtotal += $total;
							@endphp
						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/one.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$cartItem->name}}</a></h4>
							</td>
							<td class="cart_price">
								<p>{{number_format($cartItem->price).'  đ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$cartItem->quantity}}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
                        
  
							<td class="cart_total">
                               
								<p class="cart_total_price">{{number_format($cartItem->price * $cartItem->quantity).'  đ'}}</p>
							</td>

                        
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{route('home.delete_cart_item',$cartItem->id)}}"><i class="fa fa-times"></i></a>
							</td>
							@endforeach
						</tr>
						<!-- <tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="cart_description"><h4>Subtotal</h4></td>

							<td class="cart_total_price"></td>
						</tr> -->
						
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<!-- <div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div> -->
			<div class="row">
				<div class="col-sm-6">
					<!-- <div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Dùng Mã Giảm Giá</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Ước tính hàng & Thuế:</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div> -->
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Ước tính: <span>{{ number_format($subtotal)}}đ</span></li>
							<!-- <li>Eco Tax <span></span></li> -->
							<li>Phí Ship: <span>Free</span></li>
							<li>Tổng: <span>{{ number_format($subtotal)}}đ</span></li>
						</ul>
							<!-- <a class="btn btn-default update" href="">Update</a> -->
							<a class="btn btn-default check_out" href="{{route('orders.create')}}">Đặt Hàng</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection 
	

