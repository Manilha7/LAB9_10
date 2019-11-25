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
 return view('welcome');
}); 



Route::get('/blog', 'Blog@index' ); 

Route::get('/blog/register', 'Blog@register' );
Route::post('/blog/register_action', 'Blog@register_action' );
Route::get('/blog/login', 'Blog@login' ); 
Route::post('/blog/login_action', 'Blog@login_action' );
Route::get('/blog/logout', 'Blog@logout' );

Route::get('/blog/post', 'Blog@post' );
Route::get('/blog/post/{blog_id}', 'Blog@post' );
Route::post('/blog/post_action', 'Blog@post_action' );
Route::post('/blog/post_action/{blog_id}', 'Blog@post_action' ); 