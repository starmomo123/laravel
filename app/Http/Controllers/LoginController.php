<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //登录页面
    public function index()
    {
        if(\Auth::check()){
            return redirect('/posts');
        }
        return view('login.index');
    }

    //登录行为
    public function login()
    {
        //数据验证
        $this->validate(request(),[
            'email'=>'required|email',
            'password'=>'required|min:6',
            'is_remember'=>'integer'
        ]);
        $user=request(['email','password']);
        $is_remember=boolval(request('is_remember'));

        if(Auth::attempt($user,$is_remember)){
            return redirect('/posts');
        }
        //返回到上一个页面并提示错误提示
        return \Redirect::back()->withErrors('邮箱密码错误');
    }

    //登出行为
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
