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
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <?php
  $message=Session::get('message');
  if ($message) {
    echo '<span class="textalert">'.$message.'</span>';
    Session::put('message',null);
    } 
    $i=1;
?>
    <div class="table-responsive">
    <p>Tên: <span>{{$order->name}}</span></p>
    <p>Số điện thoại: <span>{{$order->phone}}</span></p>
    <p>Email: <span>{{$order->email}}</span></p>
    <p>Địa chỉ: <span>{{$order->address}}</span></p>

    <div class="form-group">
  <label for="sel1">Status:</label>
   <form action="{{ route('admin.update-order', $order->id) }}" method="GET">
   <select class="form-control" id="sel1" name="status">
        @foreach(App\Order::ORDER_STATUS_MAPPING as $key => $status)
        <option value="{{ $key }}" @if ($order->status == $key) selected @endif>{{ $status }}</option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary mt-1">
        Update Status
    </button>
   </form>
  
    </div>

      <table class="table table-striped b-t b-light">
              
        <thead>
       
          <tr>
            <th style="width:10px;">
              ID
            </th>
            <th>Tên sản phẩm</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Price</th>
            
            <!-- <th style="width:40px;" >Ẩn/Hiện</th> -->
            <th style="font-weight: bold;">Ngày thêm</th>
            <th style="font-weight: bold;"></th>
          </tr>
        </thead>
        <tbody>
            
           @foreach($order->orderItems()->get() as $orderItem)
            <tr>
                <td style="vertical-align: middle;">{{$orderItem->id}}</td>
                <!-- <th><img width="80" height="70" src="{{URL::to('/public/upload/order/'.$order->image)}}"></th> -->
                <th style="vertical-align: middle;">{{$orderItem->product_name}}</th>
                <th style="vertical-align: middle;">{{ $orderItem->size()->first() ? $orderItem->size()->first()->number_size : null }}</th>
                <th style="vertical-align: middle;">{{ $orderItem->quantity }}</th>
                <th style="vertical-align: middle;">{{ $orderItem->price }}</th>

                <td style="vertical-align: middle;"><span class="text-ellipsis">{{$orderItem->created_at}}</span></td>

                <!-- Sửa và Xóa -->
                <td style="vertical-align: middle;">
                <a href="" class="active" ui-toggle-class="">
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

          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

@endsection            