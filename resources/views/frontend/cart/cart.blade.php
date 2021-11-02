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
							<td>Size</td>
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
								<a href=""><img width="70px" height="70px" src="{{asset('public/upload/product/'.$cartItem->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="{{route('home.product-detail',$cartItem->product_id)}}">{{$cartItem->name}}</a></h4>
							</td>
							<td>
								<p>
									{{ $cartItem->size()->first() ? $cartItem->size()->first()->number_size : null }}
									<!-- @foreach($cartItem->product()->first()->size()->get() as $item)
									  @if ($item->id == $cartItem->size)
										{{ $item->number_size }}
										@break
									  @endif
									@endforeach -->
								</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($cartItem->price).'  đ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<span style="cursor: pointer" class="cart_quantity_up" data-cart-item-id="{{ $cartItem->id }}" data-selector="up"> + </span>
									<input class="cart_quantity_input-{{ $cartItem->id }}" type="text" name="quantity" value="{{$cartItem->quantity}}" autocomplete="off" size="2">
									<span style="cursor: pointer" class="cart_quantity_down"  data-cart-item-id="{{ $cartItem->id }}" data-selector="down"> - </span>
								</div>
							</td>
							<td class="cart_total">
								<span class="cart-total-item cart_total_price-{{ $cartItem->id }}">{{number_format($cartItem->price * $cartItem->quantity)}}</span> <span>đ</span>
								<input type="hidden"  id="total-amount-{{ $cartItem->id }}" value="{{ $cartItem->price }}"/>
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
							<li>Ước tính: <span id="amount-estimate">{{ number_format($subtotal)}}đ</span></li>
							<!-- <li>Eco Tax <span></span></li> -->
							<li>Phí Ship: <span>Free</span></li>
							<li>Tổng: <span id="total_cart_amount">{{ number_format($subtotal)}}đ</span></li>
						</ul>
							<!-- <a class="btn btn-default update" href="">Update</a> -->
							<a class="btn btn-default check_out" href="{{route('orders.create')}}">Đặt Hàng</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection 
	

@section('scripts')
    <script src="{{ asset('public/js/update-cart-quantity.js') }}"></script>
@endsection 