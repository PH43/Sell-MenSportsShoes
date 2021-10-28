@extends('admin_layout')
@section('admin_conten')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật Size Sản phẩm
                        </header>
                       <div class="row w3-res-tb">
                          <div class="col-sm-4 m-b-xs">
                            <label>ID Sản phẩm : {{$product->name}}</label>
                          </div>
                          <div class="col-sm-4">
                          </div>
                        </div>
                        <div class="panel-body">
                                 <?php
                                $message=Session::get('message');
                                if ($message) {
                                  echo '<span class="textalert">'.$message.'</span>';
                                  Session::put('message',null);
                                 } 
                                 $i=1;
                               ?> 
                            <div class="position-center">
                                
                            </div>
                        </div>
                    </section>

            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>

              $(document).ready(function(){
                $('#add').on('click', function(e){
                  e.preventDefault();
                  var id =$('form div').length;
                  console.log(id);
                  $("#demo").clone().attr('id', 'demo'+id ).insertAfter("div.row:last");
                  // $('#demo'+id).children('div:last span').attr('id', 'demo'+id);
                })

                $(document).on('click', '#remove', function(e){
                  e.preventDefault();
                  if ($('form > div').length > 1){
                    $(this).parent().parent().remove();
                  }
                })
              })
            </script>
@endsection