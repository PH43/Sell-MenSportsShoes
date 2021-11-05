@extends('/../admin_layout')
@section('admin_conten')
<div class="panel-heading">
      Liệt kê order!
    </div>
</div>
    <div class="row w3-res-tb">
     
      <!-- <div class="col-sm-4">
         <a href="" class="btn btn-sm btn-success">Thêm order</a>
      </div> -->
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
      <form method="get">
          <div class="input-group">
            <input type="text" class="input-sm form-control"  name="search" value="{{ request('search') }}" placeholder="Search">
          <p>Status:</p>
           <select class="form-control" name="status">
              <option >Vui lòng chọn</option>
                @foreach(App\Order::ORDER_STATUS_MAPPING as $key => $status)
                  <option @if(request('status') == $key) selected @endif value="{{ $key }}" >{{$status}}</option>
                @endforeach
              
            </select>

            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="submit">Go!</button>
            </span>
          </div>
        </form>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
              <?php
                $message=Session::get('message');
                if ($message) {
                  echo '<span class="textalert">'.$message.'</span>';
                  Session::put('message',null);
                 } 
                 $i=1;
               ?> 
        <thead>
          <tr>
            <th style="width:10px;">
              ID
            </th>
            <th>Tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Status</th>
            <!-- <th style="width:40px;" >Ẩn/Hiện</th> -->
            <th style="font-weight: bold;">Ngày thêm</th>
            <th style="font-weight: bold;"></th>
          </tr>
        </thead>
        <tbody>
           @foreach($orders as $order) 
          <tr>
            <td style="vertical-align: middle;">{{ $order->id }}</td>


            <!-- <th><img width="80" height="70" src="{{URL::to('/public/upload/order/'.$order->image)}}"></th> -->
            <th style="vertical-align: middle;">{{$order->name}}</th>
            <th style="vertical-align: middle;">{{$order->email}}</th>
            <th style="vertical-align: middle;">{{$order->phone}}</th>
            <th style="vertical-align: middle;">{{$order->address}}</th>
            <th style="vertical-align: middle;">{{ App\Order::ORDER_STATUS_MAPPING[($order->status)] }}</th>
        
             <!-- End Ẩn hiện -->

            <td style="vertical-align: middle;"><span class="text-ellipsis">{{$order->created_at}}</span></td>

            <!-- Sửa và Xóa -->
            <td style="vertical-align: middle;">
              <a href="{{route('admin.order-detail', $order)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                
              <a onclick="return confirm('Bạn muốn xóa order này?')" href="{{route('admin.delete-order',$order->id)}}">
                <i class="fa fa-times text-danger text"></i></a>  
            </td>
            <!-- end Sửa và Xóa -->
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {!!$orders->render()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

@endsection            