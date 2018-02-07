<?php
/*
|--------------------------------------------------------------------------
| api
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//后台登录路由
Route::get('/login','LoginController@index');
//后台登录逻辑
Route::post('/login','LoginController@login');
//后台登出路由
Route::get('/logout','LoginController@logout');


Route::group(['middleware'=>'auth:admin'],function(){
    //后台主页路由
    Route::get('/home','IndexController@index');

    //管理人员模块
    Route::get('/users','UserController@index');
    //创建管理人员
    Route::get('/users/create','UserController@create');
    //创建管理人员逻辑
    Route::post('/users/store','UserController@store');
    //角色管理路由
    Route::get('/users/{user}/role','UserController@role');
    //角色管理逻辑路由
    Route::post('/users/{user}/role','UserController@updateRole');

    //文章管理模块路由
    Route::get('/posts','PostController@index');
    Route::post('/posts/{post}/status','PostController@status');

    //角色管理
    Route::get('roles','RoleController@index');
    Route::get('roles/create','RoleController@create');
    Route::post('roles/store','RoleController@store');
    Route::get('roles/{role}/permission','RoleController@permission');
    Route::post('roles/{role}/permission','RoleController@storePermission');

    //权限管理
    Route::get('permissions','PermissionController@index');
    Route::get('permissions/create','PermissionController@create');
    Route::post('permissions/store','PermissionController@store');



});
