@extends('admin_layout')
@section('admin_conten')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Update user
                        </header>
                       
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{route('admin.update-users',$edit_user->id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên users</label><span style="color:red;"> *</span>
                                    <input type="text" name="name" value="{{ $edit_user->name }}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>

                                @if ($errors->has('name'))
                                    <p style="color:red;">{{$errors->first('name') }}</p>
                                @endif

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label><span style="color:red;"> *</span>
                                    <input type="email" name="email" value="{{ $edit_user->email }}" class="form-control" id="exampleInputEmail1" placeholder="email">
                                </div>

                                @if ($errors->has('email'))
                                    <p style="color:red;">{{$errors->first('email') }}</p>
                                @endif

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="number" name="phone" value="{{ $edit_user->phone }}" class="form-control" id="exampleInputEmail1" placeholder="Slug">
                                </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label><span style="color:red;"> *</span>
                                    <input type="password" name="password" value="{{$edit_user->password}}" class="form-control" id="exampleInputEmail1" placeholder="password">
                                </div>

                                @if ($errors->has('password'))
                                    <p style="color:red;">{{$errors->first('password') }}</p>
                                @endif

                                <button type="submit" name="update_user" class="btn btn-info">update user</button>
                                </form>
                            </div>
                        </div>
                    </section>

            </div>
@endsection