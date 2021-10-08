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

use App\Http\Controllers\Frontend\ProductController;


//Trang Admin 
Route::group(['prefix' => 'admin'], function() {
   //Login và đăng kí
   Route::get('login','LoginController@index')->name('admin.show-form-login'); // => admin/login
   Route::post('auth-login','LoginController@login_dashboard')->name('admin.login');
   Route::get('register-auth','UsersController@register_auth')->name('admin.show-form-register');
   Route::post('register-save','UsersController@register_save')->name('admin.register');
   Route::get('/logout','LoginController@logout');

   //Middelware khi login mới dc vào
   Route::group(['middleware'=>'admin_login'], function() {

      //Users và phân quyền chỉ có Admin mới dc quyền này
      Route::group(['middleware'=>'admin.roles'],function(){
         Route::post('assign-roles','UsersController@assign_roles')->name('admin.assign');
         Route::get('delete-user-roles/{id}','UsersController@delete_user_roles');
         Route::get('add-users','UsersController@add_users');
         Route::post('store-users','UsersController@store_users')->name('save-add-users');
      });
      Route::namespace('Admin')->group(function() {
         Route::get('/','DashboardController@index')->name('dashboard.index'); // => admin
         Route::get('dashboard', 'DashboardController@index')->name('dashboard.dashboard'); // =>admin/dashboard
      });   
      //admin và sub_admin đều vào dc
      Route::group(['middleware'=>'auth.roles'], function(){
         Route::get('all-users','UsersController@index_users');
         //Controller trong admin
         Route::namespace('Admin')->group(function() {
            Route::group(['prefix' => 'category'], function() {
               Route::get('/show-all-category', 'CategoryController@index')->name('admin.show-category'); // =>admin/category
               Route::get('create-category', 'CategoryController@create')->name('admin.create-category');
               Route::post('save-category', 'CategoryController@store')->name('save-new-category-product');
               Route::get('/edit-category/{id}', 'CategoryController@edit');
               Route::post('/update-category/{id}', 'CategoryController@update')->name('update-category');
               Route::get('/delete-category/{id}', 'CategoryController@destroy')->name('delete-category');
            }); //End Category

            Route::group(['prefix' => 'brand'], function() {
               Route::get('/show-all-brand', 'BrandController@index')->name('admin.show-brand'); // =>admin/brand
               Route::get('create-brand', 'BrandController@create'); // =>admin/brand/create
               Route::post('save-brand', 'BrandController@store')->name('save-new-brand-product');
               Route::get('/edit-brand/{id}', 'BrandController@edit');
               Route::post('/update-brand/{id}', 'BrandController@update')->name('update-brand');
               Route::get('/delete-brand/{id}', 'BrandController@destroy')->name('delete-brand');
            }); //End Brand

            Route::group(['prefix' => 'product'], function() {
               Route::get('/show-all-product', 'ProductController@index')->name('admin.show-product'); // =>admin/product
               Route::get('/add-product','ProductController@create')->name('admin.add-product');
               Route::post('/save-product','ProductController@store')->name('admin.save-new-product');
               Route::get('/edit-product/{id}','ProductController@edit_product')->name('admin.edit-product');
               Route::post('/update-product/{id}','ProductController@update')->name('admin.update-product');
               Route::get('/active-product/{id}','ProductController@active_product')->name('admin.active-product');
               Route::get('/unactive-product/{id}','ProductController@unactive_product')->name('admin.unactive-product');
               Route::get('/delete-product/{id}','ProductController@destroy')->name('admin.delete-product');
               Route::get('/size','ProductController@size')->name('admin.size-product');
            }); //End Product
         }); //End các controler nằm trong thư mục Admin
      }); //End Middelware admin và sub_admin
   }); //End Login mới vào trang Dashboard
}); //End Trang Admin


//Trang Fronend
Route::namespace('Frontend')->group(function() {
   Route::get('/', 'HomeController@index')->name('frontend.home');
   Route::group(['prefix' => 'home'], function() {
      Route::get('/product-detail', 'HomeController@product_detail')->name('home.product-detail');
      Route::get('/show-product-category/{id}', 'HomeController@show_product_category')->name('home.show-product-category');

      Route::get('/show-product-brand/{id}', 'HomeController@show_product_category')->name('home.show-product-brand');

      Route::get('/login-register_customer', 'HomeController@login_register_customer')->name('home.login-register-customer');

      Route::get('/logout-customer', 'HomeController@logout')->name('home.logout-customer');

      Route::post('/add-customer', 'HomeController@add_customer')->name('home.add-customer');

      Route::post('/login-customer', 'HomeController@login_customer')->name('home.login-customer');

      Route::post('/add-to-cart', 'ProductController@addToCart')->name('home.add-to-cart');
   });
});


Route::get('/products', [ProductController::class, 'search']);