@extends('admin_layout')
@section('admin_conten')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm user
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{route('save-add-users')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên users</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="email">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="number" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Slug">
                                </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Slug">
                                </div>
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm users</button>
                                </form>
                            </div>
                        </div>
                    </section>

            </div>
@endsection