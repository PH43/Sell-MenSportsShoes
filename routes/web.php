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

// use App\Http\Controllers\Frontend\ProductController;


//Trang Admin 
Route::group(['prefix' => 'admin'], function() {

   Route::get('login','LoginController@index')->name('admin.show-form-login'); // => admin/login
   Route::post('auth-login','LoginController@login_dashboard')->name('admin.login');
   Route::get('register-auth','UsersController@register_auth')->name('admin.show-form-register');
   Route::post('register-save','UsersController@register_save')->name('admin.register');
   Route::get('/logout','LoginController@logout');

   Route::group(['middleware'=>'admin_login'], function() {
      //Login và đăng kí
      Route::namespace('Admin')->group(function() {
         Route::get('/', 'DashboardController@index')->name('dashboard.index'); // => admin
         Route::get('dashboard', 'DashboardController@index')->name('dashboard.dashboard'); // =>admin/dashboard
             // //Users và phân quyền
         Route::group(['middleware'=>'admin.roles'],function(){
            Route::post('assign-roles','UsersController@assign_roles');
            Route::get('delete-user-roles/{id}','UsersController@delete_user_roles');
         });

         Route::group(['middleware'=>'auth.roles'], function(){
            Route::get('all-users','UsersController@index_users'); 
            // Route::get('add-users','UserController@add_users')
            // Route::post('store-users','UserController@store_users');
         });

         Route::group(['prefix' => 'category'], function() {
            Route::get('/', 'CategoryController@index')->name('admin.show-category'); // =>admin/category
            Route::get('create', 'CategoryController@create')->name('admin.create'); // =>admin/category/create
         });

         Route::group(['prefix' => 'product'], function() {
            Route::get('/', 'ProductController@index')->name('admin.show-product'); // =>admin/product
         });

      });
   });
   
   //Brand Product
});


//Trang Fronend
Route::get('/', function () {
   return view('home_layout');
});

// Route::get('/products', [ProductController::class, 'search']);
Route::namespace('Frontend')->group(function () {
   Route::get('/products', 'ProductController@search');
});