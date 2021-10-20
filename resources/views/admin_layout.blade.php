<!DOCTYPE html>
<head>
<title>Administration @if(Auth::user()) - {{ Auth::user()->name }} @endif
</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('backend/js/raphael-min.js')}}"></script>
<script src="{{asset('backend/js/morris.js')}}"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/admin/dashboard')}}" class="logo">
        <?php
           $name=Auth::user()->name;
           if($name){
           	echo 'HELLO';
           }
           
        ?> 
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
	        <!-- <li>
	            <input type="text" class="form-control search" placeholder=" Search">
	        </li> -->
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{URL::to('backend/images/254537.png')}}">
                <span class="username">
 					<?php
                        $name=Auth::user()->name;
				           if($name){
				           	echo $name;
				           }
                     ?> 
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Thong tin tài khoản</a></li>
                <!-- <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> -->
                <li><a href="{{URL::to('admin/logout')}}"><i class="fa fa-key"></i>Dang xuat</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->

<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <!-- <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li> -->
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<!-- <li><a href="{{ route('admin.create-category') }}">Thêm danh mục</a></li> -->
						<li><a href="{{ route('admin.show-category') }}">Liệt kê danh mục</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
						<!-- <li><a href="{{URL::to('/admin/brand/create-brand')}}" >Thêm Thương Hiệu</a></li>  -->
						<li><a href="{{URL::to('/admin/brand/show-all-brand')}}">Liệt Kê Thương Hiệu </a></li>
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<!-- <li><a href="{{route('admin.add-product')}}">Thêm sản phẩm</a></li> -->
						<li><a href="{{route('admin.show-product')}}">Liệt kê sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bình luân</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('admin.show-list-comment')}}">Liệt kê bình luận</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('admin.show-order')}}">Quản lý đơn hàng</a></li>
                    </ul>
                    <!-- <ul class="sub">
						<li><a href="{{url::to('manager-order')}}">Quản lý đơn hàng</a></li>
                    </ul> -->
                </li>
                <!-- kiểm tra coi id đang đăng nhập có những quyền nào -->
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('admin/all-users')}}">Liệt kê Users</a></li>
                    </ul>
                </li>
             
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->

<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- //market-->
		@yield('admin_conten')
		<!-- //market-->
</section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2021 Hello Phạm Văn Cường <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->

<script src="{{asset('backend/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('backend/js/scripts.js')}}"></script>
<script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->

	<script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
	<script>

		$.validate({
		});

	</script>

	<script src="{{asset('frontend/ckeditor/ckeditor.js')}}"></script>
	<script type="text/javascript">
	    CKEDITOR.replace('exampleInputPassword1');
	    CKEDITOR.replace('ckeditor1');
	    CKEDITOR.replace('ckeditor2');
	    CKEDITOR.replace('ckeditor3');
	    CKEDITOR.replace('ckeditor4');
	    CKEDITOR.replace('ckeditor5');
	    CKEDITOR.replace('ckeditor6');
	    CKEDITOR.replace('ckeditor7');
	</script>

<script type="text/javascript">
    $('.comment_duyet_btn').click(function(){
        var status = $(this).data('status');

        var id = $(this).data('comment_id');
        var product_id = $(this).attr('id');
        if(status==0){
            var alert = 'Thay đổi thành duyệt thành công';
        }else{
            var alert = 'Thay đổi thành bỏ duyệt thành công';
        }
          $.ajax({
                url:"{{url('/admin/allow-comments')}}",
                method:"POST",

                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{status:status,id:id,product_id:product_id},
                success:function(data){
                    location.reload();
                   $('#notify_comment').html('<span class="text text-alert">'+alert+'</span>');
                }
            });
    });
    $('.btn-reply-comment').click(function(){
        var id = $(this).data('comment_id');
        var desc = $('.reply_comment_'+id).val();
        var product_id = $(this).data('product_id');
          $.ajax({
                url:"{{url('/admin/reply-comment')}}",
                method:"POST",

                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{desc:desc,id:id,product_id:product_id},
                success:function(data){
                    location.reload();
                    $('.reply_comment_'+id).val('');
                   $('#notify_comment').html('<span class="text text-alert">Trả lời bình luận thành công</span>');
                }
            });
    });
</script>

<script src="{{asset('backend/js/jquery.scrollTo.js')}}"></script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<!-- //calendar -->
</body>
</html>