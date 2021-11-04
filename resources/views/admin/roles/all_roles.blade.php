@extends('admin_layout')
@section('admin_conten')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê roles
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4 m-b-xs">
        <a href="{{route('admin.add-roles')}}" class="btn btn-sm btn-success">Thêm Roles</a>         
      </div>
      <div class="col-sm-5">
      </div>
      <div class="col-sm-3">
      </div>
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span style="color:red" class="text-alert" >'.$message.'</span>';
                                Session::put('message',null);
                            }
                            $i=1;
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:15px;">Stt</th>
            <th>Tên role</th>
            <th>Mô tả role</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $key => $role)

              <tr>
                <td><?= $i++;  ?></td>
                <td>{{ $role->roles_name }}</td>
                <td>{{ $role->roles_name }}</td>
                <td>
                 <a href="{{route('admin.edit-roles',$role->id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a><br>
                <a  onclick="return confirm('Bạn muốn xóa Role này?')" href="{{route('admin.delete-roles',$role->id)}}">
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
            {{-- {!!$roles->render()!!} --}}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection