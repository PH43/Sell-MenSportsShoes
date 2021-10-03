@extends('admin_layout')
@section('admin_conten')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê users
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4 m-b-xs">
        <a href="{{URL::to('/admin/add-users')}}" class="btn btn-sm btn-success">Thêm User</a>         
      </div>
      <div class="col-sm-5">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            $i=1;
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:15px;">Stt</th>
          
            <th>Tên user</th>
            <th>Email</th>
            <th>Phone</th>
            <!-- <th>Password</th> -->
            <th>Admin</th>
            <th style="width:10px;">Sub Admin</th>
            <th>Shipper</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($admin as $key => $user)
            <form action="{{ route('admin.assign') }}" method="POST">
              @csrf
              <tr>
               
                <td><?= $i++;  ?></td>
                <td>{{ $user->name }}</td>
                <td>
                  {{ $user->email }} 
                  <input type="hidden" name="admin_email" value="{{ $user->email }}">
                  <input type="hidden" name="admin_id" value="{{ $user->id }}">
                </td>
                <td>{{ $user->phone }}</td>
                <!-- <td>{{ $user->password }}</td> -->

                <td><input type="checkbox" name="admin_role" {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="sub_admin_role"  {{$user->hasRole('sub_admin') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="shipper_role"  {{$user->hasRole('shipper') ? 'checked' : ''}}></td>
              
              <td>
                  
                    
                 <p><input type="submit" value="Phân quyền" class="btn btn-sm btn-default"></p>
                 <p><a style="margin:5px 0;" onclick="return confirm('Bạn muốn xóa Users này?')" class="btn btn-sm btn-danger" href="{{URL::to('/admin/delete-user-roles/'.$user->id)}}">Xóa users</a></p>
                  <p><a style="margin:5px 0;" class="btn btn-sm btn-success" href="{{url('/impersonate/'.$user->id)}}">Chuyển quyền</a></p>
                
              </td> 

              </tr>
            </form>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {!!$admin->render()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection