<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', ['uses'=>'PostController@index' , 'as'=>'post.index']);

// Article Routes...
Route::get('/posts/add',['uses'=>'PostController@add' , 'as'=>'post.add']);
Route::get('/posts/{nickName?}',['uses'=>'PostController@index' , 'as'=>'post.index']);
Route::post('/post',['uses'=>'PostController@store', 'as'=>'post.store']);
Route::get('/post/{id}',['uses'=>'PostController@show', 'as'=>'post.show']);
Route::get('/post/delete/{id}',['uses'=>'PostController@delete', 'as' => 'post.delete']);

//Comments Routes...
Route::post('/comments', ['uses'=>'CommentController@index', 'as'=>'comment.index']);



// User Routes...
Route::get('/profile',['uses'=>'UserController@index','as'=>'user.index']);
Route::get('/profile/{nickName}',['uses'=>'UserController@show','as'=>'user.show']);
Route::put('/profile/update',['uses'=>'UserController@update','as'=>'user.update']);
//Route::post('/profile/update/',['uses'=>'UserController@update','as'=>'user.update']);

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index');
