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
//Trang Admin Login
Route::get('/login','LoginController@index');
Route::post('/auth-login','LoginController@login_dashboard');
Route::get('/dashboard','LoginController@show_dashboard');
Route::get('/logout','LoginController@logout');
Route::get('/register-auth','UsersController@register_auth');
Route::post('/register-save','UsersController@register_save');
//End Trang Admin

//Brand Product

//End Brand Product