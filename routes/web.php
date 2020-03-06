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
 //Route::resource('users', 'UsersController');
// 创建用户的页面
Route::get('/users/{user}', 'UsersController@show')->name('users.show');
// 用户注册页面
Route::post('/users','UsersController@store')->name('users.store');

// 显示用户登录页面表单
Route::get('login','SessionsController@login')->name('login');
//登录处理
Route::post('login','SessionsController@store')->name('login');
//退出登录
Route::delete('logout','SessionsController@logout')->name('logout');

// 编辑用户
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}','UsersController@update')->name('users.update');

//显示所有用户列表
Route::get('/users','UsersController@index')->name('users.index');

Route::delete('/users{user}','UsersController@destroy')->name('users.destroy');

//激活路由
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//密码重设功能
//显示重置密码的邮箱发送页面
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//邮箱发送重设链接
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//密码更新页面
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//执行密码更新操作
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');