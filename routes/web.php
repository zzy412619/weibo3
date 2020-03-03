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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/','StaticPagesController@home')->name('home');
Route::get('help','StaticPagesController@help')->name('help');
Route::get('about','StaticPagesController@about')->name('about');
//注册
Route::get('signup','UsersController@signup')->name('signup');
// 第一个参数为资源名称，第二个参数为控制器名称。
// Route::resource('users', 'UsersController');
// 显示用户信息
Route::get('/users/{user}', 'UsersController@show')->name('users.show');
// 用户注册页面
Route::post('/users','UsersController@store')->name('users.store');

// 显示用户登录页面表单
Route::get('login','SessionsController@login')->name('login');
//登录处理
Route::post('login','SessionsController@store')->name('login');

