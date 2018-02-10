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



Route::group(['middleware'=>'auth:admin'],function(){
    //后台主页路由
    Route::get('/home','IndexController@index');

    //后台登出路由
    Route::get('/logout','LoginController@logout');


    Route::group(['middleware'=>'can:system'],function(){
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

    Route::group(['middleware'=>'can:posts'],function(){
        //文章管理模块路由
        Route::get('/posts','PostController@index');
        Route::post('/posts/{post}/status','PostController@status');
    });

    Route::group(['middleware'=>'can:topic'],function(){
        //文章管理模块路由
        Route::get('/topics','TopicController@index');
        Route::get('/topics/create','TopicController@create');
        Route::post('/topics/store','TopicController@store');

        Route::get('/topics/{topic}','TopicController@delete')->where('topic','[0-9]+');
    });

    Route::group(['middleware'=>'can:notice'],function(){
        //文章管理模块路由
        Route::get('/notices','NoticeController@index');
        Route::get('/notices/create','NoticeController@create');
        Route::post('/notices/store','NoticeController@store');
        Route::get('/notices/{notice}','NoticeController@delete')->where('notice','[0-9]+');
    });

});
