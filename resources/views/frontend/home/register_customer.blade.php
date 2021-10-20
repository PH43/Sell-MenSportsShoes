@extends('home_layout')
@section('conten') 

<section id="form" style="margin-top: 80px;margin-left: 40px;"><!--form-->
	<?php
                $message=Session::get('message');
                if ($message) {
                  echo '<span style="color:red;font-size: 20px;
   											 margin-left: 15px;" class="textalert">'.$message.'</span>';
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
						<input type="email" placeholder="Tài khoản" required name="email" value="{{ old('name') }}" />
						<input type="password" placeholder="Password" required name="password" value="{{ old('password') }}" />
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
						<input type="text" placeholder="Name" name="name" value="{{ old('name') }}" required />
						@if ($errors->has('name'))
              <p style="color:red;">{{$errors->first('name') }}</p>
            @endif
						<input type="email" placeholder="Email" name="email" value="{{ old('email') }}" required />
 						@if ($errors->has('email'))
              <p style="color:red;">{{$errors->first('email') }}</p>
            @endif
						<input type="text" placeholder="Phone" name="phone" value="{{ old('phone') }}" required />
						@if ($errors->has('phone'))
                <p style="color:red;">{{$errors->first('phone') }}</p>
            @endif
						<input type="password" placeholder="Password" name="password" required />
						@if ($errors->has('password'))
                <p style="color:red;">{{$errors->first('password') }}</p>
            @endif
						<button type="submit" class="btn btn-default">Đăng kí</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->

@endsection