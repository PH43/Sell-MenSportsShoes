@extends('/../admin_layout')
@section('admin_conten')
<div class="panel-heading">
      Liệt kê sản phẩm!
    </div>
</div>
    <div class="row w3-res-tb">
     
      <div class="col-sm-4">
         <a href="{{ route('admin.add-product') }}" class="btn btn-sm btn-success">Thêm Sản Phẩm</a>
      </div>
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <!-- <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div> -->
      </div>
    </div><br>
    <div class="table-responsive">
       <?php
                $message=Session::get('message');
                if ($message) {
                  echo '<span class="textalert">'.$message.'</span>';
                  Session::put('message',null);
                 } 
                 $i=1;
               ?> 
      <table class="table table-striped b-t b-light" id="myTable"> 
        <thead>
          <tr>
            <th style="width:10px;">
              Stt
            </th>
            <th>Tên sản phẩm</th>
            <th>Hình sản phẩm</th>
            <th>Thư viện ảnh</th>
            <th>Giá</th>
            <th>Mô tả sản phẩm</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Số lượng trong kho</th>
            <th style="width:40px;" >Ẩn/Hiện</th>
            <th style="font-weight: bold;">Ngày thêm</th>
            <th style="font-weight: bold;"></th>
          </tr>
        </thead>
        <tbody>
           @foreach($all_product as $product) 
          <tr>
            <td style="vertical-align: middle;"><?= $i++;  ?></td>
            <td style="vertical-align: middle;"><a href="{{route('admin.size-product',$product->id)}}">{{$product->name}}</a></td>

            <th><img width="80" height="70" src="{{URL::to('/public/upload/product/'.$product->image)}}"></th>
            <td style="vertical-align: middle;"><a href="{{route('admin.gallery-product',$product->id)}}">Thêm hình ảnh</a></td>

            <td style="vertical-align: middle;">{{number_format($product->price).'đ'}}</td>
            <td style="vertical-align: middle;">{!!$product->desc!!}</td>
            <th style="vertical-align: middle;">{{$product->category->name}}</th>
            <th style="vertical-align: middle;">{{$product->brand->name}}</th>
            <th style="vertical-align: middle;">{{$product->inventory}}</th>

            <!-- @foreach($product->size as $key => $sizes)
              <td style="vertical-align: middle;" ><input style="width: 40px" type="number" name="'size_{{$sizes->number_size}}" value="<?=  $qly=($sizes->number_size)?$sizes->pivot->quantity : 0 ?>" ></td>
            @endforeach -->

            <!-- Ẩn hiện -->
	            <td style="vertical-align: middle;"><span class="text-ellipsis">
	              <?php 
	                if ($product->status == 0) {
	              ?>    
	                  <a href="{{route('admin.active-product',$product->id)}}"><span style="padding:3px" class="btn-danger">Ẩn</span></a>

	              <?php  } else { ?>
	              <a href="{{route('admin.unactive-product',$product->id)}}"><span style="padding:3px;border-radius: 5px;" class="btn-success">Hiện</span></a>
	              <?php    
	                }
	               ?>
	            </span></td>
             <!-- End Ẩn hiện -->

            <td style="vertical-align: middle;"><span class="text-ellipsis">{{$product->created_at}}</span></td>

            <!-- Sửa và Xóa -->
            <td style="vertical-align: middle;">
              <a href="{{route('admin.edit-product',$product->id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                
              <a onclick="return confirm('Bạn muốn xóa sản phẩm này?')" href="{{route('admin.delete-product',$product->id)}}">
                <i class="fa fa-times text-danger text"></i></a>  
            </td>
            <!-- end Sửa và Xóa -->
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{--<footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {!!$all_product->render()!!}
          </ul>
        </div>
      </div>
    </footer>--}}
  </div>
</div>

@endsection            