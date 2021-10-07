@extends('welcome')
@section('conten') 
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Thông tin người nhận hàng</p>
							<div class="form-one">
								<form action="{{URL::to('/save-checkout')}}" method="post">
										{{csrf_field()}}
									<input type="text" placeholder="Name" name="shipping_name" required>
									<input type="text" placeholder="Email*" name="shipping_email" required >
									<input type="text" placeholder="Address"name="shipping_address" required>
									<input type="text" placeholder="Phone"name="shipping_phone" required>
									<textarea id="ckeditor1" name="shipping_notes" placeholder="Notes about your order, Special Notes for DeliveryNotes about your order, Special Notes for DeliveryNotes about your order, Special Notes for DeliveryNotes about your order, Special Notes for DeliveryNotes about your order, Special Notes for Delivery" rows="8"></textarea>
									<button  type="submit" name="shipping_order" class="btn btn-default check_out">Submit</button>
								</form>
							</div>
						</div>
					</div>				
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
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
						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/one.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">Colorblock Scuba</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$59</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$59</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->
@endsection