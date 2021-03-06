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

//显示首页
Route::get('/','PagesController@root')->name('root');

//------Auth::routes(); 等同于下面 9 行----
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//------Auth::routes(); 等同于上面 9 行----


//用户资源路由
Route::resource('users','UsersController',['only'=>['show','update','edit']]);


//话题（帖子）资源路由(laravel代码生成器自动生成)
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
//话题（帖子）show路由
Route::get('topics/{topic}/{slug?}','TopicsController@show')->name('topics.show');


//分类资源路由
Route::resource('categories','CategoriesController',['only'=>['show']]);


//上传图片
Route::post('upload_image','TopicsController@uploadImage')->name('topics.upload_image');


//回复（帖子）资源路由(laravel代码生成器自动生成)
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

//显示消息通知
Route::resource('notifications', 'NotificationsController',['only'=>['index']]);



