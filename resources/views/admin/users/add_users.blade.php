@extends('admin_layout')
@section('admin_conten')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm user
                        </header>
                       
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{route('save-add-users')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên users</label><span style="color:red;"> *</span>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>

                                @if ($errors->has('name'))
                                    <p style="color:red;">{{$errors->first('name') }}</p>
                                @endif

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label><span style="color:red;"> *</span>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" placeholder="email">
                                </div>

                                @if ($errors->has('email'))
                                    <p style="color:red;">{{$errors->first('email') }}</p>
                                @endif

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" id="exampleInputEmail1" placeholder="Slug">
                                </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label><span style="color:red;"> *</span>
                                    <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Slug">
                                </div>

                                @if ($errors->has('password'))
                                    <p style="color:red;">{{$errors->first('password') }}</p>
                                @endif

                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm users</button>
                                </form>
                            </div>
                        </div>
                    </section>

            </div>
@endsection