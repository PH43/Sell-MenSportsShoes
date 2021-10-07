@extends('welcome')
@section('conten') 
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
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
						<?php 
							// $cart=Cart::content();
							// dd($cart);
						 ?>
						@foreach(Cart::content() as $v_content)

						<tr>
							<td class="cart_product">
								<a href="#"><img height="100" width="130" src="{{URL::to('public/upload/product/'.$v_content->options->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Web ID: {{$v_content->id}}-Mã Code sản phẩm</p>
							</td>
							<td class="cart_price" >
								<p>{{number_format($v_content->price).' '.'$'}}</p>
							</td>
							<form action="{{URL::to('/update-cart/'.$v_content->rowId)}}" method="POST">
								{{csrf_field()}}
							<td class="cart_quantity" >
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="text" name="quantity_qty" value="{{$v_content->qty}}" autocomplete="off" size="2">
									<input type="hidden" name="rowId_cart" value="{{$v_content->rowId}}">
									<input type="submit" name="update_qty" value="update">
								</div>
							</td>
							</form>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php 
										$subtotal= $v_content->price * $v_content->qty;
										echo number_format($subtotal).' '.'$';
									 ?>
								</p>
							</td>
							<td class="cart_delete">
								<a onclick="return confirm('Bạn muốn xóa đơn hàng này?')" class="cart_quantity_delete" href="{{URL::to('/home/detele-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td> 
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		<section style="margin-bottom: 0;" id="do_action">
			<div class="container">
					<div class="row">
					<div style="margin-bottom:-80px ;" class="col-sm-6">
						<div class="total_area">
							<ul>
								<li>Cart Sub Total <span>{{Cart::subtotal().' '.'$'}}</span></li>
								<li>Eco Tax <span>{{Cart::tax().' '.'$'}}</span></li>
								<li>Shipping Cost <span>Free</span></li>
								<li>Total <span>{{Cart::total().' '.'$'}}</span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section><!--/#do_action-->
			<div style="margin-left: 20px;margin-bottom: 20px;">
				<h4 style="margin:35px 0;font-size: 20px;">Chọn hình thức thanh toán</h4>
				<form action="{{URL::to('/order-place')}}" method="POST">
					{{ csrf_field() }}
					<div class="payment-options">
						<span>
							<label><input name="payment_options" value="1" type="checkbox"> Thanh toán bằng thẻ ATM</label>
						</span>
						<span>
							<label><input name="payment_options" value="2" type="checkbox"> Thanh toán bằng tiền mặt</label>
						</span>
						<span>
							<label><input name="payment_options" value="3" type="checkbox"> Ghi nợ</label>
						</span>
					</div>
					<input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm">
				</form>
			</div>
		</div>
	</section> 
@endsection
	