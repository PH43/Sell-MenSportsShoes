@extends('home_layout')
@section('conten')
@if (session('message'))
    <h2 style="color:green;"><strong>{{ session('message')}}</strong></h2>
@endif

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Trang chủ</a></li>
				  <li class="active">Đặt Hàng</li>
				</ol>
			</div>

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Thông tin mua hàng</p>
							<form method="get" action="">
							@csrf
								<label>Tên:</label><p>{{$order->name}}</p>
								<label>Email:</label><p>{{$order->email}}</p>
								<label>Địa chỉ:</label><p>{{$order->address}}</p>
								<label>Số điện thoại:</label><p>{{$order->phone}}</p>
                            
                            </form>
						</div>
					</div>
					
				</div>
			</div>
			<!-- <div class="review-payment">
				<h2>Kiểm tra & Thanh toán</h2>
			</div> -->

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
                            @foreach($order->orderItems()->get() as $orderItem)
                                @php
                                    $total= ($orderItem->price * $orderItem->quantity);
                                    $subtotal += $total;
                                @endphp
						<tr>
							<td class="cart_product">
								<a href=""><img  width="70px" height="70px" src="{{asset('public/upload/product/'.$orderItem->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$orderItem->product_name}}</a></h4>
								
							</td>
							<td >
								{{ $orderItem->size()->first() ? $orderItem->size()->first()->number_size : null }}
								
							</td>
							<td class="cart_price">
								<p>{{number_format($orderItem->price).'  đ'}}</p>
							</td>
							<td class="cart_quantity">
								
							<p>{{$orderItem->quantity}}</p>
					
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{number_format($orderItem->price * $orderItem->quantity).'  đ'}}</p>
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

	