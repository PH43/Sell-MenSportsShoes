@extends('home_layout')
@section('conten') 

<section id="form" style="margin-top: 80px;margin-left: 40px;"><!--form-->
	<?php
                $message=Session::get('message');
                if ($message) {
                  echo '<span class="textalert">'.$message.'</span>';
                  Session::put('message',null);
                 } 
                 $i=1;
    ?> 
	<div class="container">
		<div class="row">
			<div class="col-sm-3 col-sm-offset-0">
				<div class="login-form"><!--login form-->
					<h2>Đăng nhập tài khoản của bạn</h2>
					<form action="{{route('home.login-customer')}}" method="post">
						{{csrf_field()}}
						<input type="email" placeholder="Tài khoản" required name="email" />
						<input type="password" placeholder="Password" required name="password" />
						<span>
							<input type="checkbox" class="checkbox"> 
							Ghi nhớ lần đăng nhập
						</span>
						<button type="submit" class="btn btn-default">Đăng nhập</button>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">OR</h2>
			</div>
			<div class="col-sm-4">
				<div class="signup-form"><!--sign up form-->
					<h2>Đăng kí</h2>
					<form action="{{route('home.add-customer')}}" method="post">
						{{csrf_field()}}
						<input type="text" placeholder="Name" name="name" required />
						<input type="email" placeholder="Email" name="email" required />
						<input type="text" placeholder="Phone" name="phone" required />
						<input type="password" placeholder="Password" name="password" required />
						<button type="submit" class="btn btn-default">Đăng kí</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->

@endsection