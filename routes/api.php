<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
////Route::get('blog/{name}/{age}',function($name,$age){
////    return "我的姓名：{$name};我的年龄：{$age}";
////});
//
//Route::get('blog/{name}/{age}','BlogController@getBlog');
//
//Route::match(['get','post'],'test1',function(){
//    return "我是test1";
//});
//
//Route::any('test2',function(){
//    return "我是test2";
//});
//
//Route::get('home',function(){
//    return response('hello world','200')
//        ->header('Content-Type', 'text/plain');
//});