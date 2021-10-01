<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home_layout');
});
//Login và đăng kí
Route::get('/login','LoginController@index');
Route::post('/auth-login','LoginController@login_dashboard');
Route::get('/register-auth','UsersController@register_auth');
Route::post('/register-save','UsersController@register_save');

//Trang Admin 
Route::group(['middleware'=>'adminlogin'],function(){

   Route::get('/dashboard','LoginController@show_dashboard');
   Route::get('/logout','LoginController@logout');

   //Users và phân quyền
   Route::group(['middleware'=>'admin.roles'],function(){
      Route::post('assign-roles','UsersController@assign_roles');
      Route::get('delete-user-roles/{id}','UsersController@delete_user_roles');
   });

   Route::group(['middleware'=>'auth.roles'],function(){
      Route::get('all-users','UsersController@index_users');
      // Route::get('add-users','UserController@add_users')
      // Route::post('store-users','UserController@store_users');
   });
   

//Brand Product

});