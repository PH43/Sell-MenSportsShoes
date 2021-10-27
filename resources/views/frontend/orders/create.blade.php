@extends('home_layout')
@section('conten')


	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Trang chủ</a></li>
				  <li class="active">Đặt Hàng</li>
				</ol>
			</div><!--/breadcrums-->

			<!-- <div class="step-one">
				<h2 class="heading">Step1</h2>
			</div>
			<div class="checkout-options">
				<h3>New User</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<label><input type="checkbox"> Register Account</label>
					</li>
					<li>
						<label><input type="checkbox"> Guest Checkout</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li>
				</ul>
			</div> -->

			<!-- <div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div>/register-req -->
			


			@php
			echo session("error")
			@endphp

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Thông tin mua hàng</p>
							<form method="post" action="{{route('orders.store')}}">
							@csrf
								<label>Tên:</label><input type="text" name="name"  value="{{auth()->user()?auth()->user()->name:''}}" placeholder="Nhập tên">
								<label>Email:</label><input type="email" name="email" value="{{auth()->user()?auth()->user()->email:''}}" placeholder="Nhập Email">
								<label>Địa chỉ:</label><input type="text" name="address" value="{{auth()->user()?auth()->user()->address:''}}" placeholder="Nhập địa chỉ">
								<label>Số điện thoại:</label><input type="number" name="phone" value="{{auth()->user()?auth()->user()->phone:''}}" placeholder="Nhập số điện thoại">
                            
                            <input class="btn btn-primary" type="submit" value="Xác nhận mua hàng">
                            </form>
						</div>
					</div>
					<!-- <div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form>
									<input type="text" placeholder="Company Name">
									<input type="text" placeholder="Email*">
									<input type="text" placeholder="Title">
									<input type="text" placeholder="First Name *">
									<input type="text" placeholder="Middle Name">
									<input type="text" placeholder="Last Name *">
									<input type="text" placeholder="Address 1 *">
									<input type="text" placeholder="Address 2">
								</form>
							</div>
							<div class="form-two">
								<form>
									<input type="text" placeholder="Zip / Postal Code *">
									<select>
										<option>-- Country --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<select>
										<option>-- State / Province / Region --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<input type="password" placeholder="Confirm password">
									<input type="text" placeholder="Phone *">
									<input type="text" placeholder="Mobile Phone">
									<input type="text" placeholder="Fax">
								</form>
							</div>
						</div>
					</div> -->
					<!-- <div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox"> Shipping to bill address</label>
						</div>	
					</div>					 -->
				</div>
			</div>
			<div class="review-payment">
				<h2>Kiểm tra & Thanh toán</h2>
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
								<a href=""><img  width="70px" height="70px" src="{{asset('public/upload/product/'.$cartItem->image)}}" alt=""></a>
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
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
                            @endforeach
						</tr>

						
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Ước tính:</td>
										<td>{{ number_format($subtotal)}}đ</td>
									</tr>
									<tr class="shipping-cost">
										<td>Phí Ship:</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Tổng:</td>
										<td><span>{{ number_format($subtotal)}}đ</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Ví MoMo</label>
					</span>
					<span>
						<label><input type="checkbox"> Thẻ tín dung/ Thẻ ghi nợ</label>
					</span>
					<span>
						<label><input type="checkbox"> Thanh toán khi nhận hàng</label>
					</span>
                    <span>
						<label><input type="checkbox"> Trả góp</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->

@endsection

	