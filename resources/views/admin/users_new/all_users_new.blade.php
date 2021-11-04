@extends('admin_layout')
@section('admin_conten')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê users
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-2 m-b-xs">
        <a href="{{route('add-users-new')}}" class="btn btn-sm btn-success">Thêm Users</a>         
      </div>
      <div class="col-sm-2 m-b-xs">
      <!--   <a href="{{('admin.add-roles')}}" class="btn btn-sm btn-success">Thêm Roles</a>   -->       
      </div>
      <div class="col-sm-4 m-b-xs">
            
      </div>
      <div class="col-sm-4">
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
                                echo '<span style="color:red;font-size: 21px;" class="text-alert" >'.$message.'</span>';
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
            <th>Địa chỉ</th>
            <th>Roles</th>
            <!-- <th>Password</th> -->  
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $key => $user)
              <tr>
                <td><?= $i++;  ?></td>
                <td>{{ $user->name }}</td>
                <td>
                  {{ $user->email }} 
                  <!-- <input type="hidden" name="admin_email" value="{{ $user->email }}">
                  <input type="hidden" name="admin_id" value="{{ $user->id }}"> -->
                </td>
                <td>{{ $user->phone }}</td>
                <td>Địa chỉ</td>
                <td>
                  @foreach($user->roles as $key => $role)
                  <a href="{{route('admin.edit-roles',$role->id)}}">{{$role->roles_name}}</a>,
                  @endforeach
                </td>
                <td>
                 <a href="{{route('edit-users-new',$user->id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a><br>
                <a  onclick="return confirm('Bạn muốn xóa Users này?')" href="{{URL::to('/admin/delete-user-roles',$user->id)}}">
                  <i style="text-align: center;" class="fa fa-times text-danger text"></i></a>
              </td> 
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-right text-center-xs">                
          
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {!!$users->render()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection