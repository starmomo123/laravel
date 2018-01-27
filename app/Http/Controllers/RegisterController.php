<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    //注册页面
    public function index()
    {
        return view('register.index');
    }

    //注册行为
    public function register()
    {
        //验证
        $this->validate(\request(),[
            //unique:表名,字段实现唯一验证
            'name'=>'required|unique:users,name|min:3',
            'email'=>'required|unique:users,email|email',
            //如果设置了confirmation password会与password_confirmation做比较
            'password'=>'required|min:6|confirmed'
        ]);


        //逻辑
        $name=request('name');
        $email=request('email');
        $password=bcrypt(request('password'));
        $bool = User::create(compact('name','email','password'));

        //渲染
        if($bool){
            return redirect('/login');
        }
    }
}
