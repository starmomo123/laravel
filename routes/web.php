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
    return redirect('/login');
});

//注册页面
Route::get('/register','RegisterController@index');
//注册行为
Route::post('/register','RegisterController@register');

//登录页面
Route::get('login','LoginController@index')->name('login');
//登录行为
Route::post('login','LoginController@login');

//路由登录验证
Route::group(['middleware'=>'auth:web'],function(){
        //登出行为
         Route::get('logout','LoginController@logout');

         //个人设置页面
        Route::get('user/me/setting','UserController@setting');
         //个人设置行为
        Route::post('user/me/setting','UserController@settingStore');
        //个人中心
        Route::get('user/{user}','UserController@index');
        //用户关注
        Route::post('user/{user}/dostar','UserController@doStar');
        //取消关注
        Route::post('user/{user}/dounstar','UserController@doUnStar');


        //通知页面
        Route::get('/notices','NoticeController@index');

         //文章列表页面
        Route::get('/posts','PostController@index');
        //文章详情页面
        //{post}对应文章model类
        Route::get('/posts/{id}','PostController@show')->where('id','[0-9]+');
         //添加文章页面
        Route::get('posts/create', 'PostController@create');
        Route::post('/posts','PostController@store');
         //文章更新页面
        Route::get('/posts/{post}/edit','PostController@edit');

        Route::put('/posts/{post}','PostController@update');
         //添加评论
        Route::post('/posts/{id}/comment','PostController@comment')->where('id','[0-9]+');
        //文章删除页面
        //使用post默认代表数据表,id则不能,除非改模型
        Route::get('/posts/{post}/delete','PostController@delete');
        //文章点赞路由
        Route::get('/posts/{post}/zan','PostController@zan');
        //文章取消赞功能
        Route::get('/posts/{post}/unzan','PostController@unzan');
        //文章搜索
        Route::post('/posts/search','PostController@search');

        //上传图片的url
        Route::any('/posts/image/upload','PostController@imageUpload');
});

